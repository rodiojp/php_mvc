<?php 
/*
Front Controller
PHP 5.4
*/

/*
Routing
*/
require "../Core/Router.php";
echo "Redirected URL = '" . $_SERVER["QUERY_STRING"] . "'";

$router  = new Router();
// Add the routes

// http://mvc.test/
// $route = '/^$/i' 
// $parameter = ['controller' => 'home', 'action' => 'index']
$router->add("",["controller" => "home", "action" => "index"]);
// http://mvc.test/posts
// $route = '^$posts/i' 
// $parameter = ['controller' => 'Posts', 'action' => 'new']
$router->add("posts",["controller" => "Posts", "action" => "new"]);
/* 
 * Excluded:
 * $router->add("posts/new",["controller" => "Posts", "action" => "new"]); 
 */
// http://mvc.test/account/register
// $route = '^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i'
// $parameter = ['controller' => 'account', 'action' => 'register']
$router->add("{controller}/{action}");
// http://mvc.test/account/123/register
// $route = '^(?P<controller>[a-z-]+)\/(?P<id>\d+)\/(?P<action>[a-z-]+)$/i'
// $parameter = ['controller' => 'account', 'id' => '126', 'action' => 'register']
$router->add("{controller}/{id:\d+}/{action}");
// http://mvc.test/admin/account/register
// $route = '^admin\/(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i'
// $parameter = ['controller' => 'account', 'action' => 'register']
$router->add("admin/{controller}/{action}");

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