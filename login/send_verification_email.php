<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 
include('../connection/connection.php');

if (isset($_POST['send_verification'])) {
    
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        
        $verification_code = generateOTP();

        
        $con = connection();
        $sql = "SELECT AccountName FROM employee WHERE Email = '$email'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullName = $row['AccountName'];
        } else {
            echo 'Error: User not found.';
            exit;
        }

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'colegiodemontalban7@gmail.com'; 
            $mail->Password = 'ekuovfzctxyxcppq'; 
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port = 465;

            $mail->setFrom('CDMPAYROLLMANAGEMENTSYSTEM@GMAIL.com', 'SYSTEM');

            
            $mail->addAddress($email);

            
            $mail->Subject = 'Verification Code';
            $mail->Body = "Dear $fullName,<br><br>Good Day!<br><br>Here is your OTP: <b>$verification_code</b>";
            $mail->isHTML(true);

            
            $mail->send();

            
            $sql = "UPDATE employee SET otp_code = '$verification_code' WHERE Email = '$email'";
            $result = $con->query($sql);

            if ($result) {
                
                echo '<script>';
                echo 'alert("Verification code sent successfully. Please check your email.");';
                echo 'window.location.href = "verify_code.php";'; 
                echo '</script>';
            } else {
                echo 'Error: Unable to update OTP code in the database.';
            }
        } catch (Exception $e) {
            echo 'Error occurred while sending verification code: ' . $mail->ErrorInfo;
        }
    } else {
        echo 'Error: Email address not found in session.';
    }
}


function generateOTP() {
    return mt_rand(100000, 999999);
}
?>
