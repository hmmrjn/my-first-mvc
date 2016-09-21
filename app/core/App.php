<?php

class App {
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];

	public function __construct() {
		print_r($this->parseUrl());
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
