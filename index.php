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
        .centering {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-40%, -50%);
        }
    </style>

    <div class="container centering">
        <div class="row">
            <div class="col-lg-4 p-5 text-white bg-success w-25">
            <?php if (!empty($user_data['profile_image'])) : ?>
                <img src="<?php echo $user_data['profile_image']; ?>" width="150" height="150" style="border-radius: 100px" alt="Profile Image">    
                <?php else : ?>
                    <p class="text-center">Add Profile Pic</p>
    <?php endif; ?>
            <h1 class="text-center">
                    <?php echo $user_data['user_fullname']; ?>
                </h1>
                <a href="upload_image.php" class="btn btn-dark fw-bold mt-3 w-50">Profile Pic</a>
                <br>
                <?php if (!empty($user_data['profile_image'])) : ?>
                    <form action="reset_image.php" method="post" class="mt-3">
                        <button type="submit" name="reset_image" class="btn btn-warning fw-bold w-50">Reset Profile Pic</button>
                    </form>
                    <?php endif; ?>
                    <a href="setting.php" class="btn btn-dark fw-bold mt-3 w-50">Setting</a>
                    <br>
                    <a href="logout.php" class="btn btn-warning w-50 fw-bold mt-3">Logout</a>
            </div>
            <div class="col-lg-4 p-5 w-50 bg-light">
                <h1 class="text-center">Welcome</h1>
                <h3>Your Subjects:</h3>
                <?php
$user_id = $user_data['user_id'];
$subject_query = "SELECT * FROM subjects WHERE user_id = '$user_id'";
$subject_result = mysqli_query($con, $subject_query);

if (mysqli_num_rows($subject_result) > 0) {
    echo "<ul>";
    $obtainMarks = 0;
    $totalMarks = 0;

    while ($subject_row = mysqli_fetch_assoc($subject_result)) {
        $obtain_marks = $subject_row['obtain_marks'];
        $total_marks = $subject_row['total_marks'];
        $subject_name = $subject_row['subject_name'];

        echo "<p>{$subject_name} - Obtained Marks: {$obtain_marks} / Total Marks: {$total_marks}</p>";
        
        $obtainMarks += $obtain_marks;
        $totalMarks += $total_marks;
    }
    echo "<b>Obtained Marks: {$obtainMarks} / Total Marks: {$totalMarks}</b>";
    echo "</ul>";
} else {
    echo "<p>You have no subjects.</p>";
}
?>

                <div class="row">
                    <a href="add_subject.php" class="btn btn-info text-light w-25 fw-bold mt-3 m-4">Add Subject</a>
                    <a href="update_subjects.php" class="btn btn-info text-light w-25 fw-bold mt-3 m-4">Update
                        Subject</a>
                    <a href="delete_subject.php" class="btn btn-info text-light w-25 fw-bold mt-3 m-4">Delete
                        Subject</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>