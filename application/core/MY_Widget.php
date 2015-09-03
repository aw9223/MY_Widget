<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Widget
{ 
    function __construct() 
    {
        // TODO
    } 
    
    function run()
    {
        // TODO
    }
    
    function __get($var)
    {
        $CI =& get_instance();
        return $CI->$var;
    }
}
	