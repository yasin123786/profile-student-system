<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_fullname = $_POST['user_fullname'];
    $user_email = $_POST['user_email'];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_query = "UPDATE users SET user_fullname = '$user_fullname', user_email = '$user_email', user_name = '$username', password = '$hashed_password' WHERE user_id = '{$user_data['user_id']}'";
    $update_result = mysqli_query($con, $update_query);

        header("Location: index.php");
        exit;
    } else {
        echo "Update failed.";
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

        <div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Setting</h1>
    </header>
  </div>
  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
  <form action="setting.php" method="post">
        <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['user_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="user_fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?php echo $user_data['user_fullname']; ?>">
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_data['user_email']; ?>">
            </div>
            <button type="submit" class="btn btn-danger text-light w-25 fw-bold mb-2">Update Profile</button>
        </form>
        <a href="delete_profile.php" class="btn btn-danger text-light w-25 fw-bold">Delete Profile</a>  
  </section>
</body>
</html>