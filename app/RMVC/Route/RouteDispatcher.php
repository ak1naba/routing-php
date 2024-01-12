<?php

namespace App\RMVC\Route;

class RouteDispatcher
{
    private RouteConfiguration $routeConfiguration;

    /**
     * @param RouteConfiguration $routeConfiguration
     */
    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {

        

        /*echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';*/
    }
}