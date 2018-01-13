<?php
namespace Core;
/*
    *   Base Controller
    *   
*/
abstract class Controller {
    
    /*
     * Parameters from matched route
     * @var array  
    */
    protected $route_params = [];
    
    /* 
    * Class contructor
    * @param string array $route_params
    * The route parameters (Controller, Action, ets.);
    * @return void
    */
    public function __construct($route_params = [])
    {
        $this->route_params = $route_params;
    }
    /* 
    * Class contructor
    * @param array 
    * The route parameters (Controller, Action, ets.);
    * @return void
    */
    public function __call($name, $args)
    {
        $method = $name . "Action";
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        }
    }
    /* 
    * Before filter - called before an action method
    */
    protected function before()
    {
    }
    /* 
    * After filter - called after an action method
    */
    protected function after()
    {
    }

}