<?php

class Router
{

	private $routes = array();

	public function __construct()
	{
	    $this->routes = Config::get('routes');
	}

    /**
     * Return request string
     * @return string
     */
	private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

	public function run()
	{
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("#$uriPattern#", $uri))
            {

                $internalRoute = preg_replace("#$uriPattern#", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));
                $params = $segments;

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                /*echo $actionName;
                die;
                */$result = call_user_func_array(array($controllerObject,$actionName), $params);
              //  $result = $controllerObject->$actionName($params);

                if ($result != null) {
                    break;
                }
            }
        }
	}

    public static function redirect($location)
    {
        header("Location: $location");
    }

}

