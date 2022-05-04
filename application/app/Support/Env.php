<?php
namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException;
use Dotenv\Dotenv;

class Env{

    /**
     * Get the the .env.example file path.
     * @param array $key
     *
     * @return boolean
     */
    public function update(array $data, $content = null)
    {
        if($content == null){
            $content = $this->getContent($backup = true);
        }
        
        // parser .env
        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $k => $line) {

            if(strpos($line, '=') === false){
                continue;
            }

            $envData = explode('=', $line);
            $envValue = str_replace($envData[0]. '=', $line);

            $lines[$k] = array($envData[0] => $envValue);

            foreach ($data as $key => $value) {

                if(!is_string($key) || !is_string($value)){
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

        // update .env
        if(!file_put_contents(base_path('.env'), $content)){
            throw new IOException;
        }

        return true;;
    }

    /**
     * @param boolean $backup 
     * @return string 
     */
    private function getContent($backup = false)
    {
        if( file_exists(base_path('.env')) ){

            $content = file_get_contents(base_path('.env'));
            Storage::put('env-backup/'. date("Y-m-d-His").'.env' , $content);
            return $content;

        }elseif( file_exists(base_path('.env.example')) ){

            return file_get_contents(base_path('.env.example'));
        }

        throw new FileNotFoundException;
    }

    /**
     * All of active env data
     * @return array .env
     */

    public function all()
    {
        return Dotenv::parse($this->getContent());
    }
    
}

?>