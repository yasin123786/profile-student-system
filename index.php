<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile System</title>
    
    <!-- css links -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <!-- js links -->
    <script src="./js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-secondary" aria-label="Fourth navbar example">
    <div class="container-fluid m-2">
      <a class="navbar-brand" href="index.php">Student Profile</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
          <a href="setting.php" class="nav-link">Setting</a>
          </li>
        </ul>
        <a href="add_subject.php" class="btn btn-dark fw-bold mx-2">Add Subject</a>
        <a href="logout.php" class="btn btn-dark fw-bold">Logout</a>
      </div>
    </div>
  </nav>

  <!-- body section 1 -->

  <div class="container mt-3">
    <h2>Welcome: <?php echo $user_data['user_firstname']; ?> <?php echo $user_data['user_lastname']; ?></h2>
    <div class="row mt-5">
        <div class="col-lg-3 col-md-6 col-sm-12">
        <?php if (!empty($user_data['profile_image'])) : ?>
                <img src="<?php echo $user_data['profile_image']; ?>" width="150" height="150" style="border-radius: 100px" alt="Profile Image">    
                <?php else : ?>
                    <p class="text-center">Add Profile Pic</p>
        <?php endif; ?>
        </div>
        <div class="col-lg-9 img-thumbnail col-md-6 col-sm-12 text-center">
            <h2>Information / Data</h2>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                    <h4>Status:</h4>
                    <p><?php echo $user_data['user_status']; ?></p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                    <h4>Email:</h4>
                    <p><?php echo $user_data['user_email']; ?></p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                    <h4>Phone No:</h4>
                    <p><?php echo $user_data['user_phone']; ?></p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                    <h4>Gender:</h4>
                    <p><?php echo $user_data['user_gender']; ?></p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                    <h4>DOB:</h4>
                    <p><?php echo $user_data['user_gender']; ?></p>
                    </div>
                    <div class="col-12">
                    <h4>Address:</h4>
                    <p><?php echo $user_data['user_address']; ?></p>
                    </div>
                    <div class="col-12">
                    <h4>Bio:</h4>
                    <p><?php echo $user_data['user_bio']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- body section 2 -->

  <div class="container mt-5 img-thumbnail">
    <h2 class="text-center mt-5">Subjects</h2>
        <?php include("send_mail.php");?>
  </div>

  <!-- body section 3 -->

  <div class="container mt-5 img-thumbnail">
    <h2 class="text-center mt-5">Chat With Other Users</h2>
    <?php
        include("chat.php");
    ?>
</div>

  <!-- footer -->

  <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
    </ul>
  </footer>
</div>
</body>

</html>