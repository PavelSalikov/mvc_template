<?php

Class Router
{
	private $rules;

	public function __construct()
	{
		$this->rules = include(ROOT . '/config/rules.php');
	}

	public function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		$uri = $this->getURI();

		foreach($this->rules as $pattern => $path){
			if (preg_match("#$pattern#", $uri)){
				$parts = explode('/', $path);
				$controllerName = ucfirst(array_shift($parts) . 'Controller');
				$actionName = 'action' . ucfirst(array_shift($parts));

				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

				if (file_exists($controllerFile)){
					include_once($controllerFile);
				}

				$controllerObject = new $controllerName;
				$result = $controllerObject->$actionName();

				if ($result != null){
					break;
				}
			}
		}
	}
}