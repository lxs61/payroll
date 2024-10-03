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
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');


body {
    background-image: url("/phpscript/img/mailbg.png"); 
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
}


.verification-container {
    background: rgba(255, 255, 255, 0.8);
    padding: 40px;
    border-radius: 10px;
    text-align: center;
    
    padding-right: 75px;
    position: relative;

    /* New border properties */
    border: 5px solid; /* Defines the width and style of the border */
    border-color: green; /* Top/bottom borders will be yellow, and left/right borders will be green */
}

.verification-container h2 {
    font-family: "Playfair Display", serif;
    font-style: italic;
    font-weight: 400;
    margin-bottom: 10px;
    margin-left: 24px;
}

.verification-container label {
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    margin-left: 22px;
    color: black;
    cursor: pointer;
    text-align: none;
}

.verification-container input[type="email"] {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 18px;
}

.verification-container button {
    background-color: rgb(241, 241, 144);
    color: black;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    margin-left: 20px;
    margin-bottom: 30px;
}

.verification-container button:hover {
    background-color: rgb(240, 240, 217);
}

.mail-logo {
    width: 150px;
    margin-bottom: 0px;
    margin-left: 27px;
}

.copyright {
    font-size: 15px;
    color: #555;
    margin-top: 20px;
    margin-left: 35px;
    margin-bottom: 0px;
}  
    </style>
</head>
<body>
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
</body>
</html>
