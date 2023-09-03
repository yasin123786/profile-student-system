<?php
session_start();
include("connection.php");    
include("functions.php");

$user_data = check_login($con);

$receiverId = $_POST['receiver_id'];
$message = mysqli_real_escape_string($con, $_POST['message']);
$senderFirstName = $user_data['user_firstname'];

$query = "INSERT INTO messages (sender_firstname, sender_id, receiver_id, message) VALUES ('$senderFirstName', {$user_data['user_id']}, $receiverId, '$message')";
mysqli_query($con, $query);

?>