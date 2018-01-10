<?php

class Router {
    /*
     *   Associative array of routes (the routing table)
     *   @var array
    */

    protected $routes = [];
    protected $params = array();
    /* 
    * Add a route to the routing table
    * @param string $route The route URL
    * @param array $params Parameters (Controller, action, ets.)
    * @return void
    */
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }
    /* 
    * Get all the routes from the routing table
    * @return array
    */
    public function getRoutes()
    {
        return $this->routes;
    }
    
    /*
    * Match the rount to the routes in the rounting table, setting the $params
    * property if a route is found.
    * @param string $url The rounte URL
    * @return boolean true if a match found, false otherwise
    */
    public function match($url)
    {
        echo "match('$url')";
        /*
        foreach ($this->routes as $route => $params) {
        
        echo "<pre>";
        var_dump($route);
        echo "</pre>";

            if ($url==$route) {
                $this->params = $params;
                return true;
            }
        }
        */
        // Match to the fixed URL format /controller/action
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        if (preg_match($reg_exp, $url, $matches)) {
            // Get named capchured group values
            foreach ($matches as $key => $match) { 
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;
        }
        return false;
    }
    
    /*
    * Get the currently mantched parameters
    * @return array
    */
    public function getParams()
    {
        return $this->params;
    }
}