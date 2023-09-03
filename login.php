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
                    $update_status = "UPDATE users SET user_status = 'Availible' WHERE user_id = '{$user_data['user_id']}'";
                    $update_result = mysqli_query($con, $update_status);
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

	<div id="box" class="container-fluid my-4 text-black py-3">
    <header class="text-center">
      <h1 class="fw-bold">Login</h1>
    </header>
  </div>
  <section class="container col-md-8 col-lg-3 img-thumbnail">
    <form method="post" class="m-2">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" id="text" class="form-control p-2" name="user_name" placeholder="Username" required>
      </div>
      <div>
        <label class="form-label">Password</label>
        <input type="password" id="text" class="form-control p-2" name="password" placeholder="Password" required>
      </div>
      <div>
        <button id="button" type="submit" value="Login" class="btn my-2 btn-dark fw-bold">Login in</button>
      </div>
	  <h5 class="text-center text-black m-2">Don't Have an Account |<a href="signup.php" class="text-black" style="text-decoration: none;"> Signup</a></h5>
    </form>
  </section>
</body>
</html>