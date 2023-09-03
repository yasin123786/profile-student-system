<?php

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

require 'subjects.php';

if ($pec > 0) {
    if ($pec < 30 && !isset($_SESSION['emailSent'])) {
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
    
        $mail->Username = 'rehanwhynot123@gmail.com';
        $mail->Password = 'flxbchmdjffbzmgh';
    
        $mail->setFrom($user_data['user_email'], 'Rehan Bhatti');
        $mail->addAddress($user_data['user_email'], $user_data['user_firstname']);
    
        $mail->isHTML(true);
        $mail->Subject = 'Student Result';
        $mail->Body = 'Student Name: ' . $user_data['user_firstname'] . ' ' . $user_data['user_lastname'] . '<br>Total Marks: ' . $totalMarks . ' Obtain Marks: ' . $obtainMarks . '<br>The Student Obtain Marks Percentage is less than 30%';
    
        if ($mail->send()) {
            $_SESSION['emailSent'] = true;
        } else {
        }
    } else if ($pec >= 30) {
        unset($_SESSION['emailSent']);
    }
} else {
}

?>
