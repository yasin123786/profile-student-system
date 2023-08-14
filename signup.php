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
    $user_dob = $_POST['user_dob'];
    $user_gender = $_POST['user_gender'];
    $user_address = $_POST['user_address'];
    $user_bio = $_POST['user_bio'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (user_firstname, user_lastname, user_email, user_phone, user_bio, user_address, user_dob, user_gender, user_name, password) VALUES ('$user_firstname', '$user_lastname', '$user_email', '$user_phone', '$user_bio', '$user_address', '$user_dob', '$user_gender', '$user_name', '$hashed_password')";

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
      <div class="col-md-4 mb-3">
        <label class="form-label">First Name </label>
        <input type="text" class="form-control" name="user_firstname" placeholder="First Name" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" placeholder="Last Name" name="user_lastname" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">E-Mail</label>
          <input type="email" class="form-control" placeholder="Your E-Mail" name="user_email" required>
        </div>
      <div class="col-md-4 mb-3">
        <label class="form-label">Phone No.</label>
        <input type="text" class="form-control" placeholder="+92 0111-000000" required name="user_phone">
      </div>
      <div class="col-md-4">
        <label class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" required name="user_dob">
      </div>
      <div class="col-md-4">
        <label class="form-label">Gender</label>
        <br>
        <label>Male</label>
        <input type="radio" class="mx-2" required value="Male" name="user_gender">
        <label>Female</label>
        <input type="radio" class="mx-2" value="Female" name="user_gender">
        <label>Others</label>
        <input type="radio" class="mx-2" value="Others" name="user_gender">
      </div>
      <div class="col-12 mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" placeholder="Street 18. New York, USA" name="user_address" required>
      </div>
      <div class="col-12 mb-3">
        <label class="form-label">Bio</label>
        <textarea class="form-control" rows="5" placeholder="Write About Yourself ! (500 Words)" required name="user_bio"></textarea>
      </div>
      <div class="col-12">
        <button id="button" type="submit" value="Signup" class="btn btn-danger w-25 fw-bold p-3">Sign Up</button>
      </div>
	  <h5 class="text-center text-light">Already Have an Account |<a href="login.php" class="text-light for-hover" style="text-decoration: none;"> Login</a></h5>
    </form>
  </section>
</body>
</html>