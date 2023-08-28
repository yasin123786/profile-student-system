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
                    <?php echo $user_data['user_firstname']; ?> <?php echo $user_data['user_lastname']; ?>
                </h1>
                    <a href="setting.php" class="btn btn-dark fw-bold mt-3 w-50">Setting</a>
                    <br>
                    <a href="logout.php" class="btn btn-warning w-50 fw-bold mt-3">Logout</a>
            </div>
            <div class="col-lg-4 p-5 w-50 bg-light">
                <h1 class="text-center">Welcome</h1>
                <h3>Your Information / Data:</h3>
                <div class="row">
                <div class="col-md-7 mt-4">
                    <h5>E-Mail</h4>
                    <p><?php echo $user_data['user_email']?></p>
                </div>
                <div class="col-md-5 mt-4">
                    <h5>Phone No.</h4>
                    <p><?php echo $user_data['user_phone']?></p>
                </div>
                <div class="col-md-7 mt-4">
                    <h5>DOB</h4>
                    <p><?php echo $user_data['user_dob']?></p>
                </div>
                <div class="col-md-5 mt-4">
                    <h5>Gander</h4>
                    <p><?php echo $user_data['user_gender']?></p>
                </div>
                <div class="col-12 mt-4">
                    <h5>Address</h4>
                    <p><?php echo $user_data['user_address']?></p>
                </div>
                <div class="col-12 mt-4">
                    <h5>Bio</h4>
                    <p><?php echo $user_data['user_bio']?></p>
                </div>
                </div>
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
        $pec = round($total_marks / $obtain_marks * 100);

        echo "<p>{$subject_name} - Obtained Marks: {$obtain_marks} / Total Marks: {$total_marks} / Percentage {$pec}%</p>";
        
        $obtainMarks += $obtain_marks;
        $totalMarks += $total_marks;
    }
    if($pec < 30){
        $to_email = "rehanwhynot123@gmail.com";
        $subject = "From Student Profile System";
        $body = "The Purpose of this mail is to inform you that your child, " . $user_data['user_firstname'] . " obtain marks less than 30% in annual exams";
        $from = $user_data['user_email'];

        mail($to_email, $subject, $body, $from);
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