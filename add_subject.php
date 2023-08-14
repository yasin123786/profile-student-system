<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $subject_name = $_POST['subject_name'];
  $obtain_marks = $_POST['obtain_marks'];
  $total_marks = $_POST['total_marks'];
  $user_id = $user_data['user_id'];

  $query = "INSERT INTO subjects (subject_name, obtain_marks, total_marks, user_id) VALUES ('$subject_name', '$obtain_marks', '$total_marks', '$user_id')";
  mysqli_query($con, $query);
  header("Location: index.php");
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
        <h1 class="fw-bold">Add Subject</h1>
    </header>
</div>
<section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form action="add_subject.php" method="post">
        <div class="mb-3">
            <label for="subject_name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subject_name" name="subject_name" required>
        </div>
        <div class="mb-3">
            <label for="obtain_marks" class="form-label">Obtain Marks</label>
            <input type="number" class="form-control" id="obtain_marks" name="obtain_marks" required>
        </div>
        <div class="mb-3">
            <label for="total_marks" class="form-label">Total Marks</label>
            <input type="number" class="form-control" id="total_marks" name="total_marks" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
</section>

</body>
</html>