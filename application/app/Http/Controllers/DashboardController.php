<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Department;
use App\Models\Admin\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // authorizeation $ability is permission name
        $totalUser = DB::table('users')
        ->select(DB::raw('COUNT(*) as value'))
        ->get();

        $totalUserStatus = DB::table('users')
                    ->select(DB::raw("SUM(status_work) as y"))
                    ->get();

        $status = $request->input('status');
        $keyword = $request->input('keyword');
        $list_act = [
            'delete' => 'Xoá tạm thời'
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xoá vĩnh viễn'
            ];
            $department = Department::onlyTrashed()->paginate(30);
        }else{
            $keyword = "";
            if($request->keyword){
                $keyword = $request->keyword;
            }
            $department =  Department::where('departments_name','LIKE',"%{$keyword}%")->paginate(30);
        }

        // $department = $this->departments->aLL();
        $count_department_active = Department::count();
        $count_department_trash = Department::onlyTrashed()->count();

        $count = [ $count_department_active ,  $count_department_trash];
        $this->authorize('dashboard.viewAny');

        $data = User::all();

        // users
        $numberOfUsers = $data->count();

        //new
        $numberOfNewUsers = $data->filter(function ($user) {
            $date = \Carbon\Carbon::parse(now());
            return $user->created_at->isSameDay($date);
        })->count();

        //banned
        $numberOfBenUsers = $data->filter(function ($user) {
            return $user->status=='banned';
        })->count();

        //unconfirmed
        $numberOfUnconformUsers = $data->filter(function ($user) {
            return $user->status=='unconfirmed';
        })->count();

        //resent_users
        $resent_users = $data->take(5);

        //registrationHistory
        $registrationHistory = User::countOfNewUsersPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

        $loginPieChart = $this->loginStatistics();
        // login user
        $user = auth()->user();
        // my resent activities
        $myActivities = $this->getMyActivities();

        $position =   Position::paginate(30);

        $item = User::paginate(30);

        return view('dashboard.index', compact([
            'registrationHistory','resent_users',
            'numberOfUsers', 'numberOfNewUsers',
            'numberOfBenUsers', 'numberOfUnconformUsers',
            'loginPieChart', 'user', 'myActivities','department','count','list_act','position','item','totalUser','totalUserStatus'])
        );
    }

    /**
     * Login statics usering platform
     */
    private function loginStatistics()
    {
        $currentMonth = date('m');
        $raw_data = Activity::select(['platform'])
                ->where('description' , 'Login In')
                ->whereMonth('created_at', (string) $currentMonth)
                ->get()->toArray();

        $data = [];
        foreach ($raw_data as $key => $value) {

            if(isset($data[$raw_data[$key]['platform']]) == false){
                $value = 0;
            }else{
                $value = $data[$raw_data[$key]['platform']]+1;
            }
            $data[$raw_data[$key]['platform']] = $value;
        }

        $backgroundColor = [];
        foreach (array_keys($data) as $key => $value) {

            $backgroundColor[$key] = $this->getRgbColor($key);
        }


        $dataset = [];
        $dataset['labels'] = array_keys($data);
        $dataset['datasets'][0] = array(
            "label" => "02",
            "data" => array_values($data),
            "hoverOffset" => 4,
            "backgroundColor" => $backgroundColor
        );

        return $dataset;
    }

    /**
     * my acitivies
     */

    public function getMyActivities()
    {
        return Activity::orderBy('created_at', 'DESC')->limit(5)->get();
    }

    public function getRgbColor($num) {

        $hash = md5('color' . $num); // modify 'color' to get a different palette

        $result = implode(",", [
            hexdec(substr($hash, 0, 2)), // r
            hexdec(substr($hash, 2, 2)), // g
            hexdec(substr($hash, 4, 2)) //b
        ]);

        return "rgb({$result})";
    }
}
