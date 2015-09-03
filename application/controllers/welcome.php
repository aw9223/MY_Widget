<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
    function __construct() 
    {
        parent::__construct();    
		  
        $this->load->helper('url');  
		
        $this->load->library('theme');  
    }
    
    function index()
    {
	$this->theme->area('contents/welcome', NULL, 'contents');
		
	$this->load->widget('default_theme_widget', TRUE);
    }
}
