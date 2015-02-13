<?php 

spl_autoload_register( 'load_classes' );


function load_classes( $class) {
	include 'class/' . $class . '.class.php';
}