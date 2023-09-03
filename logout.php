<?php

session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($con);

$update_status = "UPDATE users SET user_status = 'Offline' WHERE user_id = '{$user_data['user_id']}'";
$update_result = mysqli_query($con, $update_status);

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}

header("Location: login.php");
die;