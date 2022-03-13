<?php namespace Neifers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;
use File;

class StrToBlade extends ServiceProvider {

    function __construct(){

    }

    public function boot(){

    }

    public function register(){

    }

	public function render(String $string, String $blade_variable_name, Object $data) {

    $filename = uniqid('stb_');
    $path = storage_path("/app/db-blade-compiler/views/");
    $filepath = "$path$filename.blade.php";


		$old_template_files_list = $file_names = preg_grep('~^.*\.php$~', \scandir($path));
		foreach($old_template_files_list as $old_template_file){
			$diff_in_seconds = (strtotime("now") - strtotime(date('m/d/Y H:i:s',filemtime($path.$old_template_file))));
			if($diff_in_seconds >= 300){
			File::delete($path.$old_template_file);
			}
		}

		if(!file_exists(storage_path("/app/db-blade-compiler/views"))) {
			mkdir(storage_path("/app/db-blade-compiler/views"), 0777, true);
		}

		file_put_contents($filepath, trim($string));
		$rendered = (View($filename, [$blade_variable_name => $data]))->render();

		File::delete($filepath);

		return $rendered;
	}
}
