<?php

namespace App\RMVC\Route;

class RouteDispatcher
{
    private string $requestUri;
    private array $paramMap = [];
    private array $paramRequestMap = [];
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
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    public function saveRequestUri()
    {
        if($_SERVER['REQUEST_URI']!='/'){
            $this->requestUri =$this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }

    }
    public function clean($str)
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }
    public function setParamMap()
    {
        $routeArray = explode('/',$this->routeConfiguration->route);

        foreach ($routeArray as $paramKey=>$param){
            if(preg_match('/{.*}/',$param)){
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/','',$param);
            }
        }
    }
    public function makeRegexRequest()
    {
        $requestUriArray = explode('/',$this->requestUri);

        foreach ($this->paramMap as $paramKey=>$param){
            if(!isset($this->requestUri[$paramKey])){
                return;
            }
            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey]='{.*}';
        }
        $this->requestUri=implode('/',$requestUriArray);
        $this->prepareRegex();
    }
    private function prepareRegex(){
        $this->requestUri = str_replace('/','\/',$this->requestUri);
    }
    private function run()
    {
        if(preg_match("/$this->requestUri/",$this->routeConfiguration->route)){
           $this->render();
        }
    }
    private function render()
    {
        $ClassName=$this->routeConfiguration->controller;
        $action=$this->routeConfiguration->action;
        print((new $ClassName)->$action(...$this->paramRequestMap));

        die();
    }
}