<?php 
/*
Front Controller
PHP 5.4
*/

/*
Routing
*/
require "../Core/Router.php";
//echo "Redirected URL = '" . $_SERVER["QUERY_STRING"] . "'";

$router  = new Router();
// Add the routes
$router->add("",["controller" => "Home", "action" => "index"]);
$router->add("posts",["controller" => "Posts", "action" => "index"]);
$router->add("posts/new",["controller" => "Posts", "action" => "new"]);

// Dispay the routing table
echo "<pre>";
var_dump($router->getRoutes());
echo "</pre>";

//echo get_class($router);

