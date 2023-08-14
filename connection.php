<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "marksheet_sytem";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}
