<?php 
	/*
	 * App Core Class
	 * Creates URL & loads core controller
	 * URL FORMAT - /controller/method/params
	 */
	class Core {
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct() {
			$url = $this->getUrl();

			// Look in controllers for first value
			if(file_exists('../app/controllers/' . ucwords($url[0] . '.php'))) {
				// If it exists, set as current controller
				$this->currentController = ucwords($url[0]);
				// Unset 0 index
				unset($url[0]);
			}

			// Require the controller
			require_once '../app/controllers/' . $this->currentController . '.php';

			// Instantiate Controller class
			$this->currentController = new $this->currentController;

			// Check for second part of url
			if(isset($url[1])) {
				// Check to see if method exists in controller
				if(method_exists($this->currentController, $url[1])) {
					$this->currentMethod = $url[1];
					// Unset 1 index
					unset($url[1]);
				}
			}

			// If params exist in url;
			if($url) {
				$this->params = array_values($url);
			} else {
				$this->params = [];
			}

			// Call a callback with array of params
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}

		// Get URL parameters and convert to array
		public function getUrl() {
			if(isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
		}
	}