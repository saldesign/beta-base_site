<?php 
//Connect to DB
$database_name 			= 'betabase';
$db_user 					= 'christian';
$db_pass 					= 'VpNJVCRw9VsVSxC3';

$db = new mysqli( 'localhost', $db_user, $db_pass, $database_name );

//if there was error, kill the page
if($db->connect_errno > 0){ // -> is how mysql accesses object methods and properties
	die('Could not connect to DB:'.$db->connect_error);
}

//error reporting
error_reporting( E_ALL & ~E_NOTICE);

// define some URL / path constants to make linking easier
// URL is for href, src
// PATH is for includes
define( 'ROOT_URL', 'http://localhost/beta-base_site' );
// define( 'ROOT_URL', 'http://localhost/christian_php/beta-base_site' );

// define ( 'ROOT_PATH', 'C:\xampp\htdocs\christian_php\beta-base_site');
define ( 'ROOT_PATH', '/applications/XAMPP/xamppfiles/htdocs/beta-base_site');

// no close php