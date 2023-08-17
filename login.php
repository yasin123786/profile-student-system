<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $user_name = mysqli_real_escape_string($con, $user_name);
    $password = mysqli_real_escape_string($con, $password);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "<h3 class='wrong'>Wrong username or password!</h3>";
    } else {
        echo "<h3 class='wrong'>Wrong username or password!</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

  <style>
    .wrong{
    color: red;
    text-align: center;
  }
  </style>

	<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Login</h1>
    </header>
  </div>
  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form class="row g-3 p-5" method="post">
      <div class="col-md-6 mb-3">
        <label class="form-label">Username</label>
        <input type="text" id="text" class="form-control p-2" name="user_name" placeholder="Username" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Password</label>
        <input type="password" id="text" class="form-control p-2" name="password" placeholder="Password" required>
      </div>
      <div class="col-12">
        <button id="button" type="submit" value="Login" class="btn btn-danger w-25 fw-bold p-3">Login in</button>
      </div>
	  <h5 class="text-center text-light">Don't Have an Account |<a href="signup.php" class="text-light" style="text-decoration: none;"> Signup</a></h5>
    </form>
  </section>
</body>
</html>