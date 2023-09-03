<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (isset($_GET['subject_id']) && is_numeric($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];    
    
    $delete_query = "DELETE FROM subjects WHERE id = '$subject_id' AND user_id = '$user_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        header('Location: index.php');
    } else {
        header("Location: login.php"); // Replace 'login.php' with your actual login page
        exit();
    }
} 
} else {
    echo "Invalid subject ID.";
}

?>