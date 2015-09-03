<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme {
	
    var $final_title = '';
    var $loaded_areas = array();
    var $cached_vars = array();  
    
    function __construct() 
    {
    }

    function get_area($key)
    {
        return isset($this->loaded_areas[$key]) ? $this->loaded_areas[$key] : '';
    }
	
    function area($view, $vars = array(), $key = '') 
    { 
        if ($key == '')
        {
            $path = explode('/', $view);
            $key = end($path);
        }

        $CI =& get_instance(); 

        $view = $CI->load->view($view, $vars, TRUE);
        
        if ($view == '')
        {
            return FALSE;
        }
 
        $this->loaded_areas[$key] = $view;
        
        return $view;
    }
	
    function vars($vars = array(), $val = '') // 변수
    {
        if (is_string($vars))
        {
            $vars = array($vars => $val);
        }

        if (count($vars) > 0)
        {
            foreach ($vars as $key => $val)
            {
                $this->cached_vars[$key] = $val;
            }
        }
    }
	
    function get_title()
    {
        return $this->final_title;
    }

    function set_title($title)
    {
        $this->final_title = $title;

        return $this;
    }
 
    function prepend_title($title)
    {
        if ($this->final_title == '')
        {
            $this->final_title = $title;
        }
        else
        {
            $this->final_title = $title . $this->final_title;
        }

        return $this;
    }

    function append_title($title)
    {
        if ($this->final_title == '')
        {
            $this->final_title = $title;
        }
        else
        {
            $this->final_title .= $title;
        }

        return $this;
    } 
    
    function view($view, $vars = array(), $return = FALSE) // 최종 결과물.
    { 
        $CI =& get_instance(); 
		
        if (count($vars) > 0)
        {
            $this->vars($vars);
        }
        
        $view = $CI->load->view($view, $this->cached_vars, TRUE);
        
        if ($return == FALSE) 
        {
            $CI->output->append_output($view);
        }
        
        return $view;
    }
}