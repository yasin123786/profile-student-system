<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $user_data['user_id'];
    $image_name = $_FILES['profile_image']['name'];
    $image_tmp = $_FILES['profile_image']['tmp_name'];
    $image_type = $_FILES['profile_image']['type'];

    $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($image_extension, $allowed_extensions)) {
        $image_path = "profile_images/" . $user_id . "-profile." . $image_extension;
        move_uploaded_file($image_tmp, $image_path);

        $update_query = "UPDATE users SET profile_image = '$image_path' WHERE user_id = '$user_id'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            header("Location: index.php");
            exit;
        } else {
            echo "Update failed.";
        }
    } else {
        echo "Invalid file format. Allowed formats: JPG, JPEG, PNG, GIF.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Image</title>
</head>
<body>

<link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">

	<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
      <h1 class="fw-bold">Profile Pic</h1>
    </header>
  </div>
  <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
  <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_image" class="w-100 text-light bg-danger mb-3" accept="image/*" required>
        <br>
        <button type="submit" class="btn btn-danger text-light">Upload Image</button>
    </form>
  </section>
    
</body>
</html>
