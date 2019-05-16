<?php
	$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
	$dotenv->load();

	// DB params
	define('DB_HOST', $_ENV['DB_HOST']);
	define('DB_USER', $_ENV['DB_USER']);
	define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
	define('DB_NAME', $_ENV['DB_NAME']);

	// App root
	define('APPROOT', dirname(dirname(__FILE__)));
	// URL root
	define('URLROOT', 'http://localhost/apostletwo');
	// Site name
	define('SITENAME', 'Apostle of the God Hand CYOA');