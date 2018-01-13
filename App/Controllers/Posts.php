<?php 
/*
Posts Controller
PHP 7.1
*/
namespace App\Controllers;

class Posts extends \Core\Controller
{
    /*
    *  Show the index page
    *
    *  @return void
    */
    public function indexAction()
    {
        echo "Hello from Index() action method of Posts controller ";
    }

    /*
    *  Show the add new page
    *
    *  @return void
    */
    public function addNewAction()
    {
        echo "Hello from AddNew() action method of Posts controller ";
    }

    /*
    *  Show the edit page
    *
    *  @return void
    */
    public function editAction()
    {
        echo "Hello from edit() action method of Posts controller ";
        echo "<p>Query string parameters: <pre>" . 
        htmlspecialchars(print_r($this->route_params, true)) . 
        "</pre></p>";
    }
}
