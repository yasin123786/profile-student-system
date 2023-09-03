<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_bio = $_POST['user_bio'];
    $user_address = $_POST['user_address'];
    $user_dob = $_POST['user_dob'];
    $user_gender = $_POST['user_gender'];
    
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $user_firstname = mysqli_real_escape_string($con, $user_firstname);
    $user_lastname = mysqli_real_escape_string($con, $user_lastname);
    $user_email = mysqli_real_escape_string($con, $user_email);
    $user_phone = mysqli_real_escape_string($con, $user_phone);
    $user_bio = mysqli_real_escape_string($con, $user_bio);
    $user_address = mysqli_real_escape_string($con, $user_address);
    $user_dob = mysqli_real_escape_string($con, $user_dob);
    $user_gender = mysqli_real_escape_string($con, $user_gender);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_phone = '$user_phone', user_bio = '$user_bio', user_address = '$user_address', user_dob = '$user_dob', user_gender = '$user_gender', user_name = '$username', password = '$hashed_password' WHERE user_id = '{$user_data['user_id']}'";
    $update_result = mysqli_query($con, $update_query);

        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

        <div id="box" class="container-fluid my-4 text-dark py-3">
    <header class="text-center">
      <h1 class="fw-bold">Setting</h1>
    </header>
  </div>
  <section class="container col-md-8 col-lg-3 img-thumbnail">
      <form action="setting.php" method="post">
        <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['user_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div  class="mb-3">
                <label for="user_firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_data['user_firstname']; ?>">
            </div>
            <div class="mb-3">
                <label for="user_lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_data['user_lastname']; ?>">
            </div>
            <div  class="mb-3">
                <label for="user_email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_data['user_email']; ?>">
            </div>
            <div class="mb-3">
                <label for="user_phone" class="form-label">Phone No.</label>
                <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo $user_data['user_phone']; ?>">
            </div>
            <div class="mb-3">
        <label class="form-label">Gender</label>
        <br>
        Male: <input type="radio" value="Male" class="p-2" name="user_gender" required>
        <br>
        Female: <input type="radio" value="Female" class="p-2" name="user_gender">
        <br>
        Others: <input type="radio" value="Others" class="p-2" name="user_gender">
            </div>
            <div  class="mb-3">
                <label for="user_dob" class="form-label">DOB</label>
                <input type="date" class="form-control" id="user_dob" name="user_dob" value="<?php echo $user_data['user_dob']; ?>">
            </div>
            <div class="col-12 mb-3">
                <label for="user_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $user_data['user_address']; ?>">
            </div>
            <div class="col-12 mb-3">
                <label for="user_bio" class="form-label">Bio</label>
                <input type="text" class="form-control" id="user_bio" name="user_bio" value="<?php echo $user_data['user_bio']; ?>">
            </div>
        <button type="submit" class="btn btn-dark text-light fw-bold mb-4">Update Profile</button>
        <a href="delete_profile.php" class="btn btn-dark text-light fw-bold mb-4">Delete Profile</a>  
        <a href="index.php" class="btn btn-dark text-light fw-bold mb-4">Cancel</a>
    </form>
    <a href="upload_image.php" class="btn btn-dark text-light fw-bold">Profile Pic</a>
    <?php if (!empty($user_data['profile_image'])) : ?>
        <form action="reset_image.php" method="post" class="mt-3">
                <button type="submit" name="reset_image" class="btn btn-dark text-light fw-bold">Reset Profile Pic</button>
        </form>
        <?php endif; ?>
  </section>
</body>
</html>