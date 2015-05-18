<?php
	
	class RouteController
	{
		protected $controller;
		protected $action;
		static $_instance;
		static $params;
		static $format;
		static $view;
		
		public static function getInstance()
		{
			if(!(self::$_instance instanceOf self))
				self::$_instance = new self();
			return self::$_instance;
		}
		
		private function __construct()
		{
			$request = $_SERVER['REQUEST_URI'];
			$splits = explode('/',trim($request,'/'));
			$this->controller = !empty($splits[PATH]) ? ucfirst($splits[PATH]).'Controller' : 'AutoController';
			$this->action = !empty($splits[PATH + 1]) ? $splits[PATH + 1].'Action' : 'allAutoAction';
			if(!empty($splits[PATH + 2]))
			{
				self::$params = $splits[PATH + 2];
			}
			$ext = substr(strstr($request, '.'), 1);
			self::$format = (!empty($ext)) ? $ext : ENC_DATA;
			self::$view = new View();
		}
		
		public function run()
		{
			if(class_exists($this->getController()))
			{
				$rc = new ReflectionClass($this->getController());
				if($rc->hasMethod($this->getAction()))
				{
					$controller = $rc->newInstance();
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
				}
				else
				{
					self::$view->getError(404); 
				}
			}
			else
			{
				self::$view->getError(404);
			}
		}
		
		public static function getParams()
		{
			return self::$params;
		}
		
		public static function getFormat()
		{
			return self::$format;
		}
		
		function getController()
		{
			return $this->controller;
		}
		function getAction()
		{
			return $this->action;
		}
	}
