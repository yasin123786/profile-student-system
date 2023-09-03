<?php
session_start();
include("connection.php");

$receiverId = $_POST['receiver_id'];
$userId = $_SESSION['user_id'];

$query = "SELECT m.message, u.user_firstname 
          FROM messages m
          INNER JOIN users u ON m.sender_id = u.user_id
          WHERE (m.sender_id = {$receiverId} AND m.receiver_id = {$userId}) 
          OR (m.sender_id = {$userId} AND m.receiver_id = {$receiverId})";

$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<i>{$row['user_firstname']}: {$row['message']}<br><i>";
}

?>