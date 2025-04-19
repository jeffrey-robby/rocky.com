<?php
$host = "localhost";
$user = "root";
$password = "";
try {
	$database = new mysqli($host, $user, $password, "rushcompta");
} catch (Exception $e) {
	die("database not found :".$e);
}