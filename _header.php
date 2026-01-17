<?php ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
	session_start();
	
}
require "db.class.php";
require "panier.class.php";
$DB = new DB();
$DB2 = new DB2();
$panier = new panier();
