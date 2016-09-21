<?php

class App {
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	public function __construct() {
		$url = $this->parseUrl();
		print_r($url);

		//controller
		if(file_exists('../app/controllers/'.$url[0].'.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once '../app/controllers/'.$this->controller.'.php';
		echo '<br>controller: '.$this->controller;
		$this->controller = new $this->controller;

		//method
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
				echo '<br>method: '.$this->method;
				unset($url[1]);
			}
		}

		//params
		//array_values() e.g Array([2]=>param) to Array([0]=>param)
		$this->params = $url ? array_values($url) : [];
		echo '<br>params: ';
		print_r($this->params);

		call_user_func_array([$this->controller, $this->method], $this->params);
	}
	
	//analize a url
	public function parseUrl() {
		if(isset($_GET['url'])){
			//remove a / at the end. e.g. /a/b/c/ to /a/b/c
			$url = rtrim($_GET['url'], '/');
			//allow only letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=
			$url = filter_var($url, FILTER_SANITIZE_URL);
			//divide /a/b/c into Array([0]=>a [1]=>b [2]=>c)
			$url = explode('/', $url);
			return $url;
		}
	}
}
