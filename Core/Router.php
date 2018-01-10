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
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace("/\//", "\\/", $route);
        echo "<pre>";
        echo "route_1 = '$route'";
        echo "</pre>";
        if (empty($params)) {
            echo '$params is either 0, empty, or not set at all';
        } 
        // Convert variables e.g {controller}
        $route = preg_replace("/\{([a-z]+)\}/", "(?P<\\1>[a-z-]+)", $route);
        echo "<pre>";
        echo "route_2 = '$route'";
        echo "</pre>";       
        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace("/\{([a-z]+):([^\}]+)\}/", "(?P<\\1>\\2)", $route);
        echo "<pre>";
        echo "route_3 = '$route'";
        echo "</pre>";       

        // Add start and end delimeters, and case insensitive flag
        $route = "/^" . $route . "$/i";
        echo "<pre>";
        echo "route_3 = '$route'";
        echo "</pre>";
        $this->routes[$route] = $params;
        
        // $this->routes[$route] = $params;
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
        // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                echo "<pre>";
                var_dump($route);
                echo "</pre>";
                // Get named capchured group values
                foreach ($matches as $key => $match) { 
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
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