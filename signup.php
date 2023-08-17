<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_bio = $_POST['user_bio'];
    $user_address = $_POST['user_address'];
    $user_dob = $_POST['user_dob'];
    $user_gender = $_POST['user_gender'];
    
    $user_name = mysqli_real_escape_string($con, $user_name);
    $password = mysqli_real_escape_string($con, $password);
    $user_firstname = mysqli_real_escape_string($con, $user_firstname);
    $user_lastname = mysqli_real_escape_string($con, $user_lastname);
    $user_email = mysqli_real_escape_string($con, $user_email);
    $user_phone = mysqli_real_escape_string($con, $user_phone);
    $user_bio = mysqli_real_escape_string($con, $user_bio);
    $user_address = mysqli_real_escape_string($con, $user_address);
    $user_dob = mysqli_real_escape_string($con, $user_dob);
    $user_gender = mysqli_real_escape_string($con, $user_gender);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (user_gender, user_dob, user_address, user_bio, user_phone, user_lastname, user_firstname, user_email, user_name, password) VALUES ('$user_gender', '$user_dob', '$user_address', '$user_bio', '$user_phone', '$user_lastname', '$user_firstname', '$user_email', '$user_name', '$hashed_password')";

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
        <label class="form-label">First Name</label>
        <input type="text" class="form-control p-2" name="user_firstname" placeholder="First Name" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control p-2" name="user_lastname" placeholder="Last Name" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">E-Mail</label>
        <input type="text" class="form-control p-2" name="user_email" placeholder="admin@gmail.com" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control p-2" name="user_phone" placeholder="0314-0000-999" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Gender</label>
        <br>
        Male: <input type="radio" value="Male" class="p-2" name="user_gender" required>
        <br>
        Female: <input type="radio" value="Female" class="p-2" name="user_gender">
        <br>
        Others: <input type="radio" value="Others" class="p-2" name="user_gender">
      </div>
      <div class="col-md-6">
        <label class="form-label">Dob</label>
        <input type="date" class="form-control p-2" name="user_dob" required>
      </div>
      <div class="col-12">
        <label class="form-label">Address</label>
        <input type="text" class="form-control p-2" name="user_address" placeholder="Pakistan" required>
      </div>
      <div class="col-12">
        <label class="form-label">Bio</label>
        <input type="text" class="form-control p-2" name="user_bio" placeholder="(500 Words)" required>
      </div>
      <div class="col-12">
        <button id="button" type="submit" value="Signup" class="btn btn-danger w-25 fw-bold p-3">Sign Up</button>
      </div>
	  <h5 class="text-center text-light">Already Have an Account |<a href="login.php" class="text-light for-hover" style="text-decoration: none;"> Login</a></h5>
    </form>
  </section>
</body>
</html>