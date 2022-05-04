<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Rules\DBCheckConnection;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Support\Installer;
use Illuminate\Support\Facades\Schema;
use File;
use Str;

class InstallController extends Controller
{

    public $db = [];

    /**
     * temp file 
     */
    public $temp_path;


    public function __construct()
    {
        config(['app.asset_url', Installer::get_site_url() ]);
        $this->temp_path = storage_path('app/installer.json');

        if(!file_exists($this->temp_path)){
            File::put($this->temp_path, json_encode(['init' => true], true));
        }else{
            $this->db = json_decode( File::get($this->temp_path), true);
        }
    }

    /**
     * set db
     */
    private function setDB($key, $values)
    {
        if(is_string($key)){
            $this->db[$key] = $values;
            File::put($this->temp_path, json_encode($this->db, true));
        }
    }

    /**
     * get db
     */
    private function getDB($key)
    {
        if(isset($this->db[$key]) == true){
            return $this->db[$key];
        }
        return null;
    }

    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {        
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('optimize:clear');

        $this->getDB("init");

        // create storage link
        if(!file_exists(getcwd(). DIRECTORY_SEPARATOR. 'uploads')){
            \Artisan::call('storage:link'); 
        }
        return view('installer.welcome');
    }

    /**
     * Display the requirements page.
     * @return \Illuminate\Http\Response
     */
    public function requirements()
    {
        $requirements = Installer::getRequirements();
        // for next page
        $next = true;
        foreach (Installer::getRequirements() as $loaded) {
            if ($loaded == false) {
                $next = false;
            }
        }

        return view('installer.requirements', compact('requirements', 'next'));
    }

    /**
     * Display the permissions check page.
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        // check requirements
        foreach (Installer::getRequirements() as $loaded) {
            if ($loaded == false) {
                return redirect()->route('install.requirements');
            }
        }
        // get permission data
        $permissions = Installer::getPermissions();
        $next = true;
        foreach (Installer::getPermissions() as $permission => $granted) {
            if ($granted == false) {
                $next = false;
            }
        }

        return view('installer.permissions', compact('permissions', 'next'));
    }

    /**
     * Show database information form
     * @return \Illuminate\Http\Response
     */
    public function databaseInfoForm()
    {
        // check requirements
        foreach (Installer::getRequirements() as $loaded) {
            if ($loaded == false) {
                return redirect()->route('install.requirements');
            }
        }
        // get permission data
        foreach (Installer::getPermissions() as $permission => $granted) {
            if ($granted == false) {
                return redirect()->route('install.permissions');
            }
        }

        return view('installer.database');
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function databaseInfo(Request $request)
    {
        // check requirements
        foreach (Installer::getRequirements() as $loaded) {
            if ($loaded == false) {
                return redirect()->route('install.requirements');
            }
        }
        // get permission data
        foreach (Installer::getPermissions() as $permission => $granted) {
            if ($granted == false) {
                return redirect()->route('install.permissions');
            }
        }

        $request->validate([
            'database_connection'   => ['in:mysql', new DBCheckConnection],
        ]);

        $dbCredentials = $request->only('database_connection', 'host', 'port', 'username', 'password', 'database');

        $this->setDB("db_credentials", $dbCredentials);
        
        return redirect()->route('install.installationShowForm');
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param DatabaseManager $dbManaget
     * @return \Illuminate\Http\Response
     */
    public function installationShowForm()
    {
        if(!$this->tryDBconnect()){
            return redirect()->route('install.databaseInfoForm')
                ->withErrors([ 'database_connection' => trans('installer_messages.database.error.connection')]);
        }

        $avalableTb = DB::select('SHOW TABLES');

        return view('installer.installation', compact('avalableTb'));
    }

    /**
     * migration and seeding .
     *
     * @return Redirector $redirect
     */
    public function installation()
    {
        if(!$this->tryDBconnect()){
            return redirect()->route('install.welcome')
            ->withErrors([ 'database_connection' => trans('installer_messages.database.error.connection')]);
        }
        
        try {
            //migrate and seed...
            if(count(DB::select('SHOW TABLES'))){
                Artisan::call('migrate:fresh');
            } else{
                Artisan::call('migrate');
            }
            
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->route('install.fails');
        }
    
        // seed
        try {
            Artisan::call('db:seed');
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return redirect()->route('install.fails');
        }

        return redirect()->route('install.admin');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        if(!$this->tryDBconnect()){
            return redirect()->route('install.welcome')
            ->withErrors([ 'database_connection' => trans('installer_messages.database.error.connection')]);
        }

        try {
            if(DB::table('migrations')->count()  < 0){
                return redirect()->route('install.installationShowForm')
                ->withErrors([
                    'database_not_empty' => trans('installer_messages.database.error.database_not_empty', ['name' => DB::connection()->getDatabaseName()]),
                ]);
            }
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }

        //post
        if($request->isMethod('post')){

            $request->validate([
                'username'        => 'required|min:5|max:255',
                'email'       => 'required|email',
                'password'    => 'required|min:8|max:255',
            ]);

            // admin role
            $role = Role::findByName('admin');
            // remove duplicate
            $users = User::where('username', $request->username)->get();
            foreach ($users as $user) {
                if( $user != null && $user->email != $request->email){
                    $user->delete();
                }
            }

            // create user
            $user = User::updateOrCreate(
                array(
                    'email' => $request->email,
                ),
                array(
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id' => $role->id,
                    'email_verified_at' => now(),
                    'avatar' => Installer::get_site_url("/uploads/users/default.png"),
                )
            );

            return redirect()->route('install.final');
        }

        $user = User::where('email', $request->email)->first();

        return view('installer.admin', compact('user'));
    }

   /**
     * Update installed file and display finished view.
     *
     * @return \Illuminate\Http\Response
     */
    public function finish(Request $request)
    {      

        if(!$this->tryDBconnect()){
            return redirect()->route('install.welcome')
            ->withErrors([ 'database_connection' => trans('installer_messages.database.error.connection')]);
        }
        if( User::first() == null ){
            return redirect()->route('install.admin')
            ->withErrors([
                'create_user_account' => trans('installer_messages.admin.error.create_user_account'),
            ]);
        }

        $db = $this->getDB('db_credentials');
        if($db == null){
            abort(404);
        }

        // setup .env
        //key and value Must be string

        $this->updateEnv([
            'APP_ENV'           => 'production',
            'APP_DEBUG'         => 'false',
            "APP_URL"           => Installer::get_site_url(),
            "ASSET_URL"         => Installer::get_site_url(),
            "DB_CONNECTION"     => $db['database_connection'],
            "DB_HOST"           => $db['host'],
            "DB_PORT"           => $db['port'],
            "DB_DATABASE"       => $db['database'],
            "DB_USERNAME"       => $db['username'],
            "DB_PASSWORD"       => $db['password'],
            "SESSION_DRIVER"    => "database",
            "MAIL_MAILER"       => "log"
        ]);

        // set default options or setting
        option(Installer::getOptions());

        $user = User::orderBy('updated_at','DESC')->first();

        // create storage link
        if(!file_exists(getcwd(). DIRECTORY_SEPARATOR. 'uploads')){
            \Artisan::call('storage:link'); 
        }

        Log::info("app_installed");

        return view('installer.finished', compact('user'));
    }

    /**
     * Update installed file and display finished view.
     *
     * @return \Illuminate\Http\Response
     */
    public function fails()
    {
        return view('installer.error');
    }

    ///-==============================================================


    /**
     * DBconnection
     */
    private function tryDBconnect()
    {
        $data = $this->getDB('db_credentials');

        if($data == null){
            return false;
        }
        try {
            config([
                "database.connections.mysql.host"     => $data['host'],
                "database.connections.mysql.port"     => $data['port'],
                "database.connections.mysql.database" => $data['database'],
                "database.connections.mysql.username" => $data['username'],
                "database.connections.mysql.password" => $data['password'],
            ]);
            DB::purge('mysql');
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('install.databaseInfoForm')
                ->withErrors([ 'database_connection' => trans('installer_messages.database.error.connection')]
            );
        }

        return false;
    }

    /**
     * Get the the .env.example file path.
     * @param array $key
     *
     * @return boolean
     */
    public function updateEnv(array $data)
    {

        $lines = explode(PHP_EOL, File::get(base_path('.env.example')) );

        foreach ($lines as $k => $line) {

            if(strpos($line, '=') === false){
                continue;
            }

            $envData = explode('=', $line);
            $lines[$k] = array($envData[0] => $envData[1]);

            // update app key
            if($envData[0] == 'APP_KEY'){
                $lines[$k] = array($envData[0] => Installer::generateRandomKey() );
            }

            foreach ($data as $key => $v) {
                $value = "{$v}";

                if(!is_string($key) || !is_string($value)){
                    Log::info("env={$key}: This value or key is incorrect");
                    throw ValidationException::withMessages(["{$key}" => 'This value or key is incorrect']);
                }
                if($key == $envData[0]){
                    $lines[$k] = array($key => $value );
                    unset($data[$key]);
                }
            }

        }

        // add
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $lines[] = array($key => $value);
            }
            $lines[] = "";
        }

        // make line
        foreach ($lines as $key => $line) {

            if(is_array($line)){
                $lines[$key] = key($line) . '=' .reset($line);
            }
        }

        $content = implode(PHP_EOL, $lines);

        (new LoadEnvironmentVariables)->bootstrap(app());
        File::put(getcwd(). DIRECTORY_SEPARATOR. 'application' .DIRECTORY_SEPARATOR. '.env', $content);
        
    }

}
