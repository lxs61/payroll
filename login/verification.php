<?php
session_start();

if(isset($_SESSION['employeeNumber'])) {   
    $employeeNumber = $_SESSION['employeeNumber'];
} else {  
    header("Location: login.php");
    exit;
}

include('../connection/connection.php');

$con = connection();

$empNum = "$employeeNumber"; 
$sql = "SELECT AccountName, Email FROM employee WHERE EmployeeNumber = '$empNum'";
$result = $con->query($sql);

if ($result->num_rows > 0) {   
    $row = $result->fetch_assoc();
    $accountName = $row['AccountName'];
    $email = $row['Email'];
    
    // Set the email in session
    $_SESSION['email'] = $email;
} else {  
    $accountName = "Unknown";
    $email = "Unknown";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <link rel="stylesheet" href="/phpscript/css/verification.css">
    <style>    

    </style>
</head>
<body>
    <div class="container">
        <div class="verification-container">
            <?php
            $image_path = '/phpscript/img/mail.png';
            ?>
            <img class="mail-logo" src="<?php echo htmlspecialchars($image_path); ?>" >
            <h2>Welcome back, <?php echo $accountName; ?>!</h2>
            <form action="send_verification_email.php" method="POST">
               <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br>
               <label for="email">Email:</label>
               <button type="submit" name="send_verification">Send OTP</button>
            </form>
        <p class="copyright">Copyright &copy; 2024, CDMPayrollManagementSystem</p>
        </div>
    </div>
</body>
</html>
