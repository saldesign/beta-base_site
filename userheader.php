<?php 
session_start(); 
//if the user is returning with a valid cookie, re-create the session
require('db-config.php'); //require will kill the page if it doesn't load successfully 
include_once('functions.php');
 ?>