<?php

class Controller {

    protected $title = null; 
    protected $view = null; 
    protected $registry = array();
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setView($view = null) {
        if ($view === null) {
            $view = debug_backtrace()[1]['function'];
        }
        if ( strpos($view, 'Action') > 0) {
            $view = substr($view, 0, strpos($view, 'Action'));
        }
        $this->view = $view;
    }
    
    public function getView() {
        return $this->view === null ? '404' : $this->view;
    }
    
    public function renderPartialview($view_name) {
        $view_path = ROOT . '/app/layouts/' . $view_name . '.php';
        if(file_exists($view_path)) {
            include $view_path;
        }

        
    }

    public function renderView() {
        if ($this->getView() ==="404") {
            $class_name = "ErrorController";
        } else {
            $class_name = get_called_class();
        }
        $controller = substr($class_name, 0, strpos($class_name, 'Controller'));
        $view_path = ROOT . '/app/views/' . strtolower($controller) . '/' . strtolower($this->getView()) . '.php';
        if(file_exists($view_path)) {
            include $view_path;
        }
    }
    
    public function renderLayout($layout = "layout") {
        if(file_exists(ROOT . '/app/layouts/'.$layout.'.php')) {
            include ROOT . '/app/layouts/'.$layout.'.php';
        }      
    }

    function __call($name, $args) {
        switch(TRUE) {
            case substr($name, -6) == "Action";
                $this->setView('404');
                $this->renderLayout('layout_404');
                exit();
            case (substr($name, 0, 3) == "get" && ctype_upper(substr($name, 3, 1)));
                $property = lcfirst(substr($name, 3));
                return $this->$property;
                break;
            case (substr($name, 0, 3) == "set" && ctype_upper(substr($name, 3, 1)));
                $property = lcfirst(substr($name, 3));
                $this->$property = $args[0];
                break;
            default;
                return FALSE;
        }
    }
    
    public function getModel($name) {
        $model = new $name();
        return $model;
    }

    
}