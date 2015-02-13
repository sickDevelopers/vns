<?php

ini_set('display_errors', '1');
date_default_timezone_set('Europe/Rome');

require_once( 'config.php' );
require 'vendor/autoload.php';
require 'src/autoloader.php';



if( isset($_GET['debug']) &&  $_GET['debug'] == 1 ) {
	if(!defined('DEBUG')) {
		define('DEBUG', 'true');
	}
	NOIA::go_debug();
	die();
}
if( isset($_GET['post']) &&  $_GET['post'] == 'yes' ) {
	NOIA::go_alone_baby();
	die();
}


if( isset($argv) && count($argv) > 1 ) {
	if( $argv[1] == '-d') {
		if(!defined('DEBUG')) {
			define('DEBUG', 'true');
		}
		NOIA::go_debug();
		die();
	}
	if( $argv[1] == '-p') {
		NOIA::go_alone_baby();
		die();
	}
	if( $argv[1] == '-h') {
		print_help();
		die();
	}
} 
if(isset($argv) && count($argv) == 1) {
	print_help();
}


function print_help() {
	echo "What do you want to do baby?\n";
	echo sprintf("-p \t\tPost a tweet\n");
	echo sprintf("-d \t\tDebug\n");
	echo sprintf("-h \t\tShow this help\n");
	echo "\n";
	echo "NOIA - sick_o - 2015\n\n";
}







