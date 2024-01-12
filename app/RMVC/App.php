<?php

namespace App\RMVC;

use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;

class App
{
    public static function run()
    {
        foreach (Route::getRoutesGet() as $routeConfiguration){

            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }

    }
}