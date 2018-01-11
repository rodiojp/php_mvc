<?php 
/*
Posts Controller
PHP 7.1
*/
namespace App\Controllers;

class Posts
{
    /*
    *  Show the index page
    *
    *  @return void
    */
    public function index()
    {
        echo "Hello from Index() method of Posts controller ";
    }

    /*
    *  Show the add new page
    *
    *  @return void
    */
    public function addNew()
    {
        echo "Hello from AddNew() method of Posts controller ";
    }
}
