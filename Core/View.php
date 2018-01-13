<?php
namespace Core;
/*
    *   Base View
    *   
*/
abstract class View {
    
    /*
     * Render a view file
     * @param string $view The view file
     * @return void
    */
    public static function render($view)
    {
        $file = "../App/Views/$view"; //Relative to Core directory
        if (\is_readable($file)) {
            require $file; 
        } else{
            echo "$file not found";
        }
    }
}