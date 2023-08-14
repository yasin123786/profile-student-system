<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reset_image'])) {
    $update_query = "UPDATE users SET profile_image = NULL WHERE user_id = '{$user_data['user_id']}'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Reset failed.";
    }
}
?>
