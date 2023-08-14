<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My website</title>
</head>
<body>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  
  <style>
    .centering{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-40%,-50%);
    }
  </style>

<div class="container centering">
    <div class="row">
        <div class="col-lg-4 p-5 text-white bg-danger w-25">
        <?php if (!empty($user_data['profile_image'])) : ?>
                <img src="<?php echo $user_data['profile_image']; ?>" width="150" height="150" style="border-radius: 100px" alt="Profile Image">    
                <?php else : ?>
                    <p class="text-center">Add Profile Pic</p>
    <?php endif; ?>    
        <h1 class="text-center"><?php echo $user_data['user_firstname']; ?> <?php echo $user_data['user_lastname']; ?></h1>
        <?php if (!empty($user_data['profile_image'])) : ?>
        <form action="reset_image.php" method="post" class="mt-3">
            <button type="submit" name="reset_image" class="btn btn-light text-danger fw-bold w-50">Reset Profile Pic</button>
        </form>
    <?php endif; ?>
        <a href="logout.php" class="btn btn-light text-danger fw-bold mt-3">Logout</a>
        <a href="upload_image.php" class="btn btn-light text-danger fw-bold mt-3 w-50">Profile Pic</a>    
        </div>
        <div class="col-lg-4 p-5 w-50 bg-light">
    <h1 class="text-center">Welcome</h1>
    <div class="row">
    <div class="col-lg-7 mt-3 px-5">
    <h5>E-Mail:</h5>
    <p><?php echo $user_data['user_email']; ?></p>
    </div>
    <div class="col-lg-5 mt-3 px-5">
        <h5>Contact No:</h5>
        <p><?php echo $user_data['user_phone']; ?></p>
    </div>
    <div class="col-lg-7 mt-2 px-5">
        <h5>Gender:</h5>
        <p><?php echo $user_data['user_gender']; ?></p>
    </div>
    <div class="col-lg-5 mt-2 px-5">
        <h5>DOB:</h5>
        <p><?php echo $user_data['user_dob']; ?></p>
    </div>
    <div class="col-lg-12 mt-2 px-5">
        <h5>Address:</h5>
        <p><?php echo $user_data['user_address']; ?></p>
    </div>
    <div class="col-lg-12 mt-2 px-5">
        <h5>Bio:</h5>
        <p><?php echo $user_data['user_bio']; ?></p>
    </div>
    </div>
    <a class="btn btn-danger mt-3 mb-3" href="update_profile.php">Update Profile</a>
    <a class="btn btn-danger mt-3 mb-3" href="delete_profile.php">Delete Profile</a>
</div>
</div>
</div>

</body>
</html>