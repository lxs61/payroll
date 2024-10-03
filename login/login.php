<?php
if (!isset($_SESSION)) {
    session_start();
}

include('../connection/connection.php');

$con = connection();
if (isset($_POST['btnlogin'])) {
    $emnum = mysqli_real_escape_string($con, $_POST['emnum']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $employeeNumber = $_POST['emnum'];
        $_SESSION['employeeNumber'] = $employeeNumber;  
    }
}

if (empty($emnum) && empty($email) && empty($password)) {
    echo "<script>alert('Input Employee Number, Email, and Password.')</script>";
} elseif (empty($emnum) && empty($email)) {
    echo "<script>alert('Please input Employee Number and Email.')</script>";
} elseif (empty($emnum) && empty($password)) {
    echo "<script>alert('Please input Employee Number and Password.')</script>";
} elseif (empty($email) && empty($password)) {
    echo "<script>alert('Please input Email and Password.')</script>";
} elseif (empty($emnum)) {
    echo "<script>alert('Please input Employee Number.')</script>";
} elseif (empty($email)) {
    echo "<script>alert('Please input Email.')</script>";
} elseif (empty($password)) {
    echo "<script>alert('Please input Password.')</script>";
} else {
    $sqllogin = "SELECT * FROM employee WHERE `EmployeeNumber` = '$emnum' AND `Email` = '$email' AND `Password` = '$password'";
    $resultlogin = mysqli_query($con, $sqllogin);

    $total = mysqli_num_rows($resultlogin);

    if ($total > 0) {
        $row = mysqli_fetch_assoc($resultlogin);
        $_SESSION['Userlogin'] = $row['Email']; 
        $_SESSION['Access'] = $row['Access']; 
        header('Location: verification.php'); 
        exit;
    } else {
        echo "<script>alert('No user found with the provided credentials.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="/phpscript/css/login.css">
    <style>
         
    </style>
</head>

<body>
<div class="navbar">
    <a class="active" href="#"><i class="fas fa-home"></i></a>
    <a href="#"><i class="fas fa-info-circle"></i></a>
    <a href="#"><i class="fas fa-cog"></i></a>
    <a href="#"><i class="fas fa-envelope"></i></a>
    <div class="nav-content">
    <?php
    $image_path = '/phpscript/img/The_Colegio_de_Montalban_Seal.png';
    ?>

    <img class="logo" src="<?php echo htmlspecialchars($image_path); ?>" alt="Colegio de Montalban Seal">
        <div class="text-container">
            <h1>COLEGIO DE MONTALBAN</h1>
            <h3>PAYROLL MANAGEMENT SYSTEM</h3>
        </div>
    </div>
</div>

 <div class="form">
 <form method="POST" action="">
            <div class="input-container">
                <input type="text" name="emnum" class="input-field" placeholder="Employee Number">
                <label for="emnum">Employee Number:</label>

                <input type="text" name="email" class="input-field" placeholder="Email">
                <label for="email">Email:</label>

                <input type="password" name="password" class="password-field" id="password" placeholder="Password">
                <label for="password">Password:</label>

                <div class="checkbox-wrapper">
                    <input type="checkbox" id="showPassword">
                    <label for="showPassword">Show Password?</label>
                </div>

                <div class="button-container">
                    <button type="submit" name="btnlogin" class="loginbutton">LOG IN</button>
                </div>
            </div>
        </form>
    </div>


<script>
    
    const passwordField = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
</script>

</body>

</html>
