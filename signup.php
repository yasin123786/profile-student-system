<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $user_fullname = $_POST['user_fullname'];
    $user_email = $_POST['user_email'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (user_fullname, user_email, user_name, password) VALUES ('$user_fullname', '$user_email', '$user_name', '$hashed_password')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

	<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Sign Up</h1>
    </header>
  </div>
  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form class="row g-3 p-5" method="post">
      <div class="col-md-6 mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control p-2" name="user_name" placeholder="Username" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Password</label>
        <input type="password" class="form-control p-2" name="password" placeholder="Password" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control p-2" name="user_fullname" placeholder="Full Name" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">E-Mail</label>
        <input type="email" class="form-control p-2" name="user_email" placeholder="admin@gmail.com" required>
      </div>
      <div class="col-12">
        <button id="button" type="submit" value="Signup" class="btn btn-danger w-25 fw-bold p-3">Sign Up</button>
      </div>
	  <h5 class="text-center text-light">Already Have an Account |<a href="login.php" class="text-light for-hover" style="text-decoration: none;"> Login</a></h5>
    </form>
  </section>
</body>
</html>