<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (delete_profile($con, $user_data['user_id'])) {

        unset($_SESSION['user_id']);
        header("Location: login.php");
        die;
    } else {
        
        echo "Delete failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Profile</title>
</head>
<body>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

	<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Delete Profile</h1>
    </header>
  </div>
  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form class="row g-3 p-5" method="post">
    <p>Are you sure you want to delete your profile?</p>
      <div class="col-12">
        <button id="button" type="submit" value="Delete Profile" class="btn btn-danger w-25 fw-bold p-3">Delete Profile</button>
      </div>
    </form>
  </section>
</body>
</html>
