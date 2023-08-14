<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject_id = $_POST['subject_id'];

    $delete_query = "DELETE FROM subjects WHERE id = '$subject_id' AND user_id = '{$user_data['user_id']}'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Delete failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Subject</title>
</head>
<body>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <div id="box" class="container-fluid my-4 text-light py-3">
        <header class="text-center">
            <h1 class="fw-bold">Delete Subject</h1>
        </header>
    </div>
    <section class="container my-2 w-50 fs-5 text-white p-2 border-radius">
        <form class="row g-3 p-5" method="post">
            <div class="mb-3">
                <label for="subject_id" class="form-label">Select Subject to Delete</label>
                <select class="form-select" id="subject_id" name="subject_id">
                    <?php
                    $user_id = $user_data['user_id'];
                    $subject_query = "SELECT * FROM subjects WHERE user_id = '$user_id'";
                    $subject_result = mysqli_query($con, $subject_query);

                    while ($subject_row = mysqli_fetch_assoc($subject_result)) {
                        echo "<option value='{$subject_row['id']}'>{$subject_row['subject_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-danger w-25 fw-bold p-3" onclick="return confirm('Are you sure you want to delete this subject?')">Delete Subject</button>
            </div>
        </form>
    </section>
</body>
</html>
