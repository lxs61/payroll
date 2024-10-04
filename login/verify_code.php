<?php
session_start();

if(isset($_POST['verify_code'])) {
    
    $entered_code = $_POST['verification_code'];
    
    $email = $_SESSION['email'];

    include('../connection/connection.php');
    $con = connection();
    $sql = "SELECT otp_code FROM employee WHERE Email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $expected_code = $row['otp_code'];

        if($entered_code == $expected_code) {

            header("Location: dashboard1.php");
            exit;
        } else {
     
            $verification_error = "Incorrect verification code. Please try again.";
        }
    } else {
     
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <link rel="stylesheet" href="/phpscript/css/verify_code.css">
    <style>
        .container{
            background: #36b31d;
            padding: 15px;
            border-radius: 15px;
        }
    </style>
    
    <script>
        function moveToNext(current, nextFieldID) {
            if (current.value.length >= current.maxLength) {
                document.getElementById(nextFieldID).focus();
            }
        }

        function gatherOTP() {
            const otpInputs = document.querySelectorAll('.otp-input');
            let otp = '';
            otpInputs.forEach(input => {
                otp += input.value;
            });
            document.getElementById('verification_code').value = otp;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="verification-container">
            <div class="verification-header">VERIFICATION CODE</div>
                <h2>One more step and you're in!</h2>
                <p class="text">Please enter the OTP we've sent to your email</p>
                <p class="text">For security, don't share your OTP</p>
            <div class="otp-inputs">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 'otp2')" id="otp1">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 'otp3')" id="otp2">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 'otp4')" id="otp3">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 'otp5')" id="otp4">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 'otp6')" id="otp5">
                <input type="text" class="otp-input" maxlength="1" id="otp6">
            </div>
                <form action="" method="POST" onsubmit="gatherOTP()">
                    <input type="hidden" id="verification_code" name="verification_code">
                    <?php if(isset($verification_error)) { ?>
                        <p style="color: red;"><?php echo $verification_error; ?></p>
                    <?php } ?>
                    <button type="submit" name="verify_code">Verify</button>
                </form>
            <p class="resend-code" onclick="window.location.href='verification.php';">Didn't receive a code?</p>
            <p class="copyright">Copyright &copy; 2024, CDMPayrollManagementSystem</p>
        </div>
    </div>
</body>
</html>
