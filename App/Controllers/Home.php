<?php 
/*
Posts Controller
PHP 7.1
*/
namespace App\Controllers;

class Home
{
    /*
    *  Show the index page
    *
    *  @return void
    */
    public function index()
    {
        echo "Hello from Index() method of Home controller ";
        echo "<p>Query string parameters: <pre>" . 
             htmlspecialchars(print_r($_GET, true)) . 
             "</pre></p>";
    }
}
