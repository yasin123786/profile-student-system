<link rel="stylesheet" href="./css/bootstrap.min.css">

<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if (isset($_GET['subject_id']) && is_numeric($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

if (isset($_SESSION['user_id'])) {
$user_id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_name = $_POST['new_name'];
        $new_obtain_marks = $_POST['new_obtain_marks'];
        $new_total_marks = $_POST['new_total_marks'];

        $update_query = "UPDATE subjects SET subject_name = '$new_name', obtain_marks = '$new_obtain_marks', total_marks = '$new_total_marks' WHERE id = '$subject_id' AND user_id = '$user_id'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            header('Location: index.php');
        } else {
            echo "Error: Unable to update subject.";
        }
    } else {
        $subject_query = "SELECT * FROM subjects WHERE id = '$subject_id' AND user_id = '$user_id'";
        $subject_result = mysqli_query($con, $subject_query);

        if (mysqli_num_rows($subject_result) > 0) {
            $subject_row = mysqli_fetch_assoc($subject_result);
            $obtain_marks = $subject_row['obtain_marks'];
            $total_marks = $subject_row['total_marks'];
            $subject_name = $subject_row['subject_name'];

            echo "<h1 class='text-center m-5'>Edit Subject: {$subject_name}</h1>
            <section class='container col-md-8 col-lg-3 img-thumbnail'>
    <form method='POST' class='m-2' action='update_subjects.php?subject_id=$subject_id'>
      <div class='mb-3'>
        <label class='form-label'>Subject Name</label>
        <input type='text' name='new_name' value='$subject_name' class='form-control p-2' required>
      </div>
      <div class='mb-3'>
        <label class='form-label'>Subject Name</label>
        <input type='text' name='new_obtain_marks' value='$obtain_marks' class='form-control p-2' required>
      </div>
      <div>
        <label class='form-label'>Password</label>
        <input type='text' name='new_total_marks' value='$total_marks' class='form-control p-2' required>
      </div>
      <div>
        <button type='submit' value='Save Changes' class='btn my-2 btn-dark fw-bold'>Update Subject</button>
        <a href='index.php' class='btn my-2 btn-dark fw-bold'>Cancel</a>
      </div>
	  </form>
  </section>
           ";
           } else {
            header("Location: login.php"); // Replace 'login.php' with your actual login page
            exit();
        }
    } 
    }
} else {
    echo "Invalid subject ID.";
}
?>