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

            // Path to the local logo image
            $logoPath = 'C:\xampp\htdocs\phpscript\img\The_Colegio_de_Montalban_Seal.png'; // Update this path

            // Attach the logo
            $mail->addEmbeddedImage($logoPath, 'logo_cid'); // 'logo_cid' is a unique ID for the image

            $mail->Body = "<html>
            <head>
                <style>
                    body {
                        margin: 0; 
                        padding: 0; 
                        font-family: Arial, sans-serif;
                        background-color: white; /* Overall background color */
                    }
                    .navbar {
                        background-color: #4CAF50;
                        padding: 20px; 
                        color: white;
                        text-align: center;
                        width: 22.4%; /* Full width */
                        position: relative; /* Ensure positioning is relative */
                        left: 0; /* Align to left */
                    }
                    .container {
                        display: flex;
                        align-items: stretch; /* Ensure child items stretch to full height */
                    }
                    .sidebar {
                        width: 20px; /* Sidebar width */
                        background-color: #4CAF50; /* Sidebar color */
                    }
                    .content {
                        flex-grow: 1; /* Allow content to grow */
                        background-color: white; 
                        padding: 20px; 
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='navbar'></div>
                <div class='container'>
                    <div class='sidebar'></div>
                    <div class='content'>
                        <img src='cid:logo_cid' alt='Logo' style='width: 80px; height: 80px; margin-bottom: 20px;'>
                        <p>Dear $fullName,</p>
                        <p>Good Day!</p>
                        <p>Here is your OTP: <b>$verification_code</b></p>                     
                        <p style='color:black; opacity:50%;'>Copyright © 2024,<br> CDMPayrollManagementSystem</p>
                    </div>
                    <div class='sidebar'></div>
                </div>
            </body>
            </html>";
            
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
