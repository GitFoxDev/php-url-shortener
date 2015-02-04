<?php

define('SITEPATH', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR);
define('SITEURL', 'http://'.$_SERVER['HTTP_HOST'].'/');

function __autoload($className)
{
	$file = SITEPATH.'api'.DIRECTORY_SEPARATOR.$className.'.php';
	if (file_exists($file) == false) {
		return false;
	}
	require_once "$file";
}

if (isset($_GET['go'])) {
	$config = require_once 'config.php';
	$link = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
	if (!$link->connect_errno) {
		$link->query("set character_set_client='utf8'");
		$link->query("set character_set_results='utf8'"); 
		$link->query("set collation_connection='utf8_general_ci'");
	} else {
		die();
	}
	
	if (($_GET['go'] == 'shorten') AND (isset($_POST['url']))) {
		$url = new Url($link, $config);
		$url->setLongUrl($_POST['url']);
		echo '<span class="message">'.$url->getShortUrl().'</span>';
	} else {
		$redirect = new Redirect($link);
		$redirect->start($_GET['go']);
	}
} else {
	$view = new View();
	echo $view->getView();
}