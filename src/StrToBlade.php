<?php namespace Neifers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;

class StrToBlade extends ServiceProvider {

    public function boot(){

    }

    public function register(){
        $this->app->singleton(StrToBlade::class);

        $this->app->alias(StrToBlade::class, 'dbview');
    }

    public function render(String $string) {
	return 'Hi '.$string;
    }
}
