<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_theme_widget extends MY_Widget
{

    function __construct() 
    {
        parent::__construct();
         
        $this->load->library('theme');
    }
    
    function _attach_header()
    {
        $this->theme->area('themes/default/header'); 
    }
    
    function _attach_footer()
    {
        $this->theme->area('themes/default/footer'); 
    }
    
    function _attach_sidebar()
    {
        $this->theme->area('themes/default/sidebar');  
    }
    
    function run($use_sidebar = TRUE)
    {
        $this->_attach_header();
        $this->_attach_footer(); 
        
        if ($use_sidebar)
        {
            $this->_attach_sidebar(); 
        }
        
        $this->theme->view('themes/default');
    }
}