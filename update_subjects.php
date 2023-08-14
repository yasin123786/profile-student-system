<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject_to_update = $_POST['subject_to_update'];
    $new_subject_name = $_POST['new_subject_name'];
    $new_obtain_marks = $_POST['new_obtain_marks'];
    $new_total_marks = $_POST['new_total_marks'];

    $update_subject_query = "UPDATE subjects SET subject_name = '$new_subject_name', obtain_marks = '$new_obtain_marks', total_marks = '$new_total_marks' WHERE id = '$subject_to_update' AND user_id = '{$user_data['user_id']}'";
    $update_subject_result = mysqli_query($con, $update_subject_query);

    if ($update_subject_result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Update failed.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Subjects</title>
</head>
<body>
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/style.css">

<div id="box" class="container-fluid my-4 text-light py-3">
    <header class="text-center">
        <h1 class="fw-bold">Update Subjects</h1>
    </header>
</div>
<section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
    <form action="update_subjects.php" method="post">
        <div class="mb-3">
            <label for="subject_to_update" class="form-label">Select Subject to Update</label>
            <select class="form-select" id="subject_to_update" name="subject_to_update">
                <?php
                $subject_query = "SELECT * FROM subjects WHERE user_id = '{$user_data['user_id']}'";
                $subject_result = mysqli_query($con, $subject_query);

                while ($subject_row = mysqli_fetch_assoc($subject_result)) {
                    echo "<option value='{$subject_row['id']}'>{$subject_row['subject_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="new_subject_name" class="form-label">New Subject Name</label>
            <input type="text" class="form-control" id="new_subject_name" name="new_subject_name" required>
        </div>
        <div class="mb-3">
            <label for="new_obtain_marks" class="form-label">New Obtain Marks</label>
            <input type="number" class="form-control" id="new_obtain_marks" name="new_obtain_marks" required>
        </div>
        <div class="mb-3">
            <label for="new_total_marks" class="form-label">New Total Marks</label>
            <input type="number" class="form-control" id="new_total_marks" name="new_total_marks" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</section>

</body>
</html>
