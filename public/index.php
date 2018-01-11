<?php 
/*
Front Controller
PHP 7.1
*/
// Require the controller class
// require "../App/Controllers/Posts.php";
/*
* Autoloader
*/
spl_autoload_register(function ($class){
    $root = dirname(__DIR__);  // get the parent directory
    $file = $root . "/" . str_replace("\\","/",$class) . ".php";
    if (is_readable($file)) {
        require $root . "/" . str_replace("\\","/",$class) . ".php";
    }
});
/*
Routing
*/
// require "../Core/Router.php";
echo "Redirected URL = '" . $_SERVER["QUERY_STRING"] . "'";

$router  = new Core\Router();
// Add the routes

// http://mvc.test/
// $route = '/^$/i' 
// $parameter = ['controller' => 'home', 'action' => 'index']
$router->add("",["controller" => "home", "action" => "index"]);
// http://mvc.test/account/register
// $route = '^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i'
// $parameter = ['controller' => 'account', 'action' => 'register']
$router->add("{controller}/{action}");
// http://mvc.test/account/123/register
// $route = '^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i'
// $parameter = ['controller' => 'account', 'id' => '126', 'action' => 'register']
$router->add("{controller}/{id:\d+}/{action}");
/* 
// Dispay the routing table
echo "<pre>";
var_dump($router->getRoutes());
echo "</pre>";

// echo get_class($router);

// Match the requested route
$url = $_SERVER["QUERY_STRING"];
if ($router->match($url)) {
    echo "<pre>";
    var_dump($router->getParams());
    echo "</pre>";
} else {
    echo "No route found for URL '$url'";
} 
*/
$router->dispatch($_SERVER["QUERY_STRING"]);