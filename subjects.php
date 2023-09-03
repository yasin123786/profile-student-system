<link rel="stylesheet" href="./css/style.css">
<?php
$user_id = $user_data['user_id'];
$subject_query = "SELECT * FROM subjects WHERE user_id = '$user_id'";
$subject_result = mysqli_query($con, $subject_query);

if (mysqli_num_rows($subject_result) > 0) {
    echo "<ul>";
    $obtainMarks = 0;
    $totalMarks = 0;
    
    echo "<div class='row mt-5 text-center'>
    <div class='col-md-3'>
        <h4>Subject Name</h4>
        <p></p>
    </div>
    <div class='col-md-3'>
        <h4>Obtain Marks</h4>
        <p></p>
    </div>
    <div class='col-md-3'>
        <h4>Total Marks</h4>
        <p></p>
    </div>
    <div class='col-md-3'>
        <h4>Action</h4>
    </div>
    </div>
    ";
    while ($subject_row = mysqli_fetch_assoc($subject_result)) {
        $subject_id = $subject_row['id'];
        $obtain_marks = $subject_row['obtain_marks'];
        $total_marks = $subject_row['total_marks'];
        $subject_name = $subject_row['subject_name'];

        echo "
        <div class='row text-center'>    
        <div class='col-3 border-bottom mt-2'>    
        <p>{$subject_name}</p>
        </div>
        <div class='col-3 border-bottom mt-2'>    
        <p>{$obtain_marks}</p>
        </div>
        <div class='col-3 border-bottom mt-2'>   
        <p>{$total_marks}</p> 
        </div>
        <div class='col-3 border-bottom mt-2'>   
        <a class='btn btn-dark fw-bold' href='update_subjects.php?subject_id=$subject_id'>Edit</a>
        <a class='btn btn-dark fw-bold' href='delete_subject.php?subject_id=$subject_id'>Delete</a> 
        </div>
        </div>
            ";

        $obtainMarks += $obtain_marks;
        $totalMarks += $total_marks;
        $pec = round($obtainMarks / $totalMarks * 100);
    }
    echo "<b>Obtained Marks: {$obtainMarks} / Total Marks: {$totalMarks} / Percentage: {$pec}%</b>";
    echo "</ul>";
} else {
    $pec = 0;
    echo "<p>You have no subjects.</p>";
}
?>
