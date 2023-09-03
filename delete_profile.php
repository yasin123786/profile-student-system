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

	<div id="box" class="container-fluid my-4 text-dark py-3">
    <header class="text-center">
      <h1 class="fw-bold">Delete Profile</h1>
    </header>
  </div>
  <section class="container col-md-8 col-lg-3 img-thumbnail">
    <form class="m-2" method="post">
    <p>Are you sure you want to delete your profile?</p>
      <div class="col-12">
        <button id="button" type="submit" value="Delete Profile" class="btn btn-dark fw-bold">Delete Profile</button>
        <a href="index.php" class="btn btn-dark text-light fw-bold">Cancel</a>
      </div>
    </form>
  </section>
</body>
</html>
