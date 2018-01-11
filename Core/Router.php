<?php
namespace Core;

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

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariables($url);
        
        if ($this->match($url)) {
            $controller = $this->params["controller"];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = "App\Controllers\\$controller";
            
            if (class_exists($controller)) {
                $controller_object = new $controller();
                $action = $this->params["action"];
                $action = $this->convertToCamelCase($action);
                if (is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    echo "Method $action in controller $controller not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo "no route $url matched";
        }
    }
    /*
    * Convert the string with hyphens to StudlyCaps, 
    * e.g. post-authors => PostAuthors
    *
    * @param string $string The string to convert
    *
    * return string;
    */
    public function convertToStudlyCaps($string)
    {
        return str_replace(" ","",ucwords(str_replace("-","",$string)));
    }
    /*
    * Convert the string with hyphens to StudlyCaps, 
    * e.g. add-new => addNew
    *
    * @param string $string The string to convert
    *
    * return string;
    */
    public function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }
    
    /*
    * Get the currently mantched parameters
    * @return array
    */
    public function getParams()
    {
        return $this->params;
    }

        /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }
}