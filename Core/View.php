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
    public static function render($view, $args = [])
    {   
        // extract variables form array into separeted variables
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view"; //Relative to Core directory
        if (\is_readable($file)) {
            require $file; 
        } else{
            echo "$file not found";
        }
    }
}