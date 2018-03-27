<?php


function mvc_autoloader($class_name){
    $lib_path = ROOT.DS.'lib'.DS.$class_name.'.php';
    $controllers_path = ROOT.DS.'controllers'.DS.$class_name;
    $model_path = ROOT.DS.'models'.DS.$class_name.'.php';
    if ( file_exists($lib_path) ){
        require_once($lib_path);
    } elseif ( file_exists($controllers_path) ){
        require_once($controllers_path);
    } elseif ( file_exists($model_path) ){
        require_once($model_path);
    } /*else {
        throw new Exception('Failed to include class: '.$class_name);
    }*/
}
spl_autoload_register('mvc_autoloader');

require_once(ROOT.DS.'config'.DS.'routes.php');