<?php
ob_start();
session_start();

//database credentials
const DB_DSN = 'mysql:host=localhost;dbname=db';
const DB_USER = 'root';
const DB_PASS = '';

$db = new PDO(DB_DSN, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/London');

/*
//load classes as needed
function __autoload($class) {
   
   $class = strtolower($class);

   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }     

   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
    }
        
     
}
//pass the database connection
$user = new User($db); 
 * 
 */
