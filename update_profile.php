<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updated_data = array(
        'user_firstname' => $_POST['user_firstname'],
        'user_lastname' => $_POST['user_lastname'],
        'user_phone' => $_POST['user_phone'],
        'user_address' => $_POST['user_address'],
        'user_dob' => $_POST['user_dob'],
        'user_gender' => $_POST['user_gender'],
        'user_email' => $_POST['user_email'],
        'user_bio' => $_POST['user_bio'],
    );

    if (update_profile($con, $user_data['user_id'], $updated_data)) {
        
        header("Location: index.php");
        die;
    } else {
        
        echo "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
</head>
<body>

<link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Update</h1>
    </header>
  </div>

  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form class="row g-3 p-5" method="post">
      <div class="col-md-4 mb-3">
          <label class="form-label">First Name </label>
          <input type="text" name="user_firstname" class="form-control p-2" value="<?php echo $user_data['user_firstname']; ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Last Name</label>
            <input type="text" name="user_lastname" class="form-control p-2" value="<?php echo $user_data['user_lastname']; ?>"><br>
        </div>
        <div class="col-md-4">
            <label class="form-label">E-Mail</label>
            <input type="email" name="user_email" class="form-control p-2" value="<?php echo $user_data['user_email']; ?>">
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Phone No.</label>
        <input type="text" name="user_phone" class="form-control p-2" value="<?php echo $user_data['user_phone']; ?>"><br>
    </div>
    <div class="col-md-4">
        <label class="form-label">Date Of Birth</label>
        <input type="date" name="user_dob" class="form-control p-2" value="<?php echo $user_data['user_dob']; ?>"><br>
    </div>
    <div class="col-md-4">
        <label class="form-label">Gender</label>
        <br>
        <label for="user_gender">Male:</label>
        <input type="radio" name="user_gender" value="Male"><br>
        <label for="user_gender">Female:</label>
        <input type="radio" name="user_gender" value="Female"><br>
        <label for="user_gender">Others:</label>
        <input type="radio" name="user_gender" value="Others"><br>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control p-2" name="user_address" value="<?php echo $user_data['user_address']; ?>">
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Bio</label>
        <textarea name="user_bio" class="form-control p-2"><?php echo $user_data['user_bio']; ?></textarea><br>
    </div>
    <div class="col-12">
        <button id="button" type="submit" value="Update Profile" class="btn btn-danger w-25 fw-bold p-3">Update</button>
    </div>
</form>
</section>
</body>
</html>
