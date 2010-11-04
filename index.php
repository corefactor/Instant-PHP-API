<?php

	# CHECK IF CONFIG.PHP FILE EXISTS
	if (file_exists('../config.php')) {
		require_once('../config.php');
	} else {
		# COMPLAIN ABOUT THE CONFIG.PHP FILE
		throw new Exception('config.php file missing.');
	}
	
	# DEBUG
	if (!isset($_GET['debug'])) {
		error_reporting(0);		
		header('Content-Type: application/json; charset=utf-8', true, 200);		
	}
	
	# DEFINE THE API TO RUN
	if (isset($_GET['api']) && file_exists(APIS_FOLDER . "/{$_GET['api']}.php")) {
		
		define('API_MODULE', APIS_FOLDER . "/{$_GET['api']}.php");
		
	}
	
	# IF ALL IS SETUP THE BOOT UP
	if (defined('API_MODULE')) {
		
		# IF DB_USE IS SET TO TRUE, INITIALIZE DB CONNECTION
		if (defined('DB_USE') && DB_USE === true) {
			include('includes/ez_sql_core.php');		
			include('includes/ez_sql_mysql.php');		
			$db = new ezSQL_mysql(DB_USERNAME, DB_PASSWORD, DB_NAME, DB_HOST);
		}
		
		#TODO IMPLEMENT CACHE SYSTEM
		/*
		# CHECK FOR CACHE FOLDER
		if (defined('CACHE_FOLDER') && (strlen(CACHE_FOLDER) > 0)) {
			include('includes/cache_handler.php');
			$CacheHandler = new CacheHandler();
		}
		*/
		
		# LOAD THE API_RESPONSE OBJECT TO BE USED BY THE MODULE
		include('includes/api_response.php');
		$ApiResponse = new ApiResponse('JSON');
		
		# LOAD THE REQUESTED API MODULE
		include(API_MODULE);
		
		if (isset($_GET['jsoncallback'])) {
		
			echo $ApiResponse->get($_GET['jsoncallback']);
			
		} else {
		
			echo $ApiResponse->get();
			
		}
					
	} else {
		
		die('You must specify a valid API to run using GET.');
		
	}

?>