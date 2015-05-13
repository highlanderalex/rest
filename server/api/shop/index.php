<?php
	
	require_once ('config.php');
    require_once ('controllers/RouteController.php');
    require_once ('controllers/AutoController.php');

	
	$route = RouteController::getInstance();
    $route->run();
    //$obj = new AutoController();
    //var_dump($obj->detailInfoAction(1));
    //echo json_encode($obj->allAutoAction());
	//echo 'Server answer';
	
