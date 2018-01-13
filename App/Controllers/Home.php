<?php 
/*
Posts Controller
PHP 7.1
*/
namespace App\Controllers;

class Home extends \Core\Controller
{
    /*
    *  Show the index page
    *
    *  @return void
    */
    public function indexAction()
    {
        echo "Hello from Index() action method of Home controller ";
       /*  
            echo "<p>Query string parameters: <pre>" . 
                htmlspecialchars(print_r($_GET, true)) . 
                "</pre></p>"; 
        */
    }
    /* 
    * Before filter - called before an action method
    */
    protected function before()
    {
        echo "(method before) ";
        // return false;
    }
    /* 
    * After filter - called after an action method
    */
    protected function after()
    {
        echo " (method after)";
    }

}
