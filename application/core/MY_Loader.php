<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader 
{ 

    protected $_ci_widget_paths = array();
            
    function __construct() 
    { 
        $this->_ci_widget_paths = array(APPPATH);
        
        parent::__construct();
    }
    
    public function add_package_path($path, $view_cascade=TRUE)
    {
        $path = rtrim($path, '/').'/';

        array_unshift($this->_ci_widget_paths, $path);
        
        parent::add_package_path($path, $view_cascade);
    }
    
    public function remove_package_path($path = '', $remove_config_path = TRUE)
    {
        if ($path == '')
        {
            $void = array_shift($this->_ci_widget_paths);
        }
        else
        {
            $path = rtrim($path, '/').'/'; 
            if (($key = array_search($path, $this->_ci_widget_paths)) !== FALSE)
            {
                unset($this->_ci_widget_paths[$key]);
            } 
        }

        $this->_ci_widget_paths = array_unique(array_merge($this->_ci_widget_paths, array(APPPATH)));
        
        parent::remove_package_path($path, $remove_config_path);
    }

    function widget($widget = '')
    {
        $args = func_get_args();
		
        if (is_array($widget))
        {
            foreach ($widget as $class)
            {
                $this->widget($class);
            }
            return;
        }

        if ($widget == '')
        {
            return;
        }

        $path = '';

        // 하위 폴더 위젯인지 체크
        if (($last_slash = strrpos($widget, '/')) !== FALSE)
        {
            $path = substr($widget, 0, $last_slash + 1);
            $widget = substr($widget, $last_slash + 1); // 마지막 슬래시를 시작으로 위젯명을 가져옴.
        }

        if (class_exists(config_item('subclass_prefix') . '_Widget') === FALSE)
        {
            load_class('Widget', 'core');
        }

        $widget = strtolower($widget);
                
        foreach ($this->_ci_widget_paths as $widget_path)
        {
            if (file_exists($widget_path.'widgets/'.$path.$widget.'.php') === FALSE)
            {
                continue;
            } 
        
            require_once($widget_path.'widgets/'.$path.$widget.'.php');

            $name = ucfirst($widget);
            $class = new $name();
            
            call_user_func_array(array($class, 'run'), array_slice($args, 1));
            return;
        }

        show_error('Unable to locate the widget you have specified: '.$widget); 
    }
}