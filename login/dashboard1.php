<?php
session_start();

if (isset($_SESSION['employeeNumber'])) {   
    $employeeNumber = $_SESSION['employeeNumber'];
} else {  
    header("Location: login.php");
    exit;
}

include('../connection/connection.php');

$con = connection();

$empNum = "$employeeNumber"; 
$sql = "SELECT AccountName, position FROM employee WHERE employeeNumber = '$empNum'";
$result = $con->query($sql);

if ($result->num_rows > 0) {   
    $row = $result->fetch_assoc();
    $accountName = $row['AccountName'];
    $position = $row['position'];
} else {  
    $accountName = "Unknown";
    $position = "Unknown";
}

$sqlHours = "SELECT Hrs FROM payslip_update WHERE EmployeeNumber = '$employeeNumber'";
$resultHours = $con->query($sqlHours);
if ($resultHours->num_rows > 0) {
    $rowHours = $resultHours->fetch_assoc();
    $hours = $rowHours['Hrs'];
} else {
    $hours = 0;
}

$sqlAttendance = "SELECT `Date`, `Time_in`, `Time_out`, `worktime` FROM `attendance` WHERE `EmployeeNumber` = '$employeeNumber'";
$resultAttendance = $con->query($sqlAttendance);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Navigation Bar</title>
    <link rel="stylesheet" href="/phpscript/css/dashboard1.css">
    
    
    <style>
     .sidebar {
    background-color: green;
    width: 295px;
    height: calc(100vh - 180px);
    position: fixed;
    top: 118px;
    left: 5px;
    z-index: 1000;
    margin-left: 8px;
    margin-top: 5px;
    margin-bottom: 20px;
    padding-bottom: 35px;
    border-radius: 10px 10px 10px 10px;
}
.logout-button {
    background-color: rgb(222, 241, 222);
    margin-top: 260px;
    margin-left: 11px;
    padding: 8px;
    border-radius: 10px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.main-content {
    background-color: green;
    width: 1200px;
    height: calc(100vh - 180px);
    position: fixed;
    top: 118px;
    left: 260px;
    z-index: 1000;
    margin-top: 5px;
    margin-bottom: 20px;
    padding-bottom: 35px;
    border-radius: 10px 10px 10px 10px;
    margin-left: 60px;
}
.box-absent {
    width: 240px;
    height: 80px;
    padding: 10px;
    background-color: white;
    border-radius: 10px;
    border: 5px solid rgb(102, 187, 102);
    text-align: center;
}
    </style>

</head>
<body>
</head>
<body>
<!-- Main bar -->
<div class="navbar">
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

    <div>
        <a class="active" href="#"><i class="fas fa-home"></i></a>
        <a href="#"><i class="fas fa-info-circle"></i></a>
        <a href="#"><i class="fas fa-cog"></i></a>
        <a href="#"><i class="fas fa-envelope"></i></a>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <div class="user">
    <?php
    $profile_image_path = '/phpscript/img/profile icon (1).png';
    ?>
    
    <img class="user-pic" src="<?php echo htmlspecialchars($profile_image_path); ?>" alt="User Profile Icon">
   
   </div>
   <?php
$totalhrs_logo_image_path = '/phpscript/img/Dashboard Icon.png';
$attendance_logo_image_path = '/phpscript/img/Attendance Icon.png';
$schedule_logo_image_path = '/phpscript/img/Schedule Icon.png';
$payslip_logo_image_path = '/phpscript/img/Payslip Icon.png';
?>
   <!-- Dashboard Button -->
   <form action="" method="post">
        <button class="dashboard" type="submit"> <img class="dashboard_logo" src="<?php echo htmlspecialchars($totalhrs_logo_image_path); ?>" alt="Dashboard Icon">DASHBOARD</button>
    </form>

    <!-- Attendance Button -->
    <form action="attendance.php" method="post">
        <button class="attendance" type="submit"> <img class="attendance_logo" src="<?php echo htmlspecialchars($attendance_logo_image_path); ?>" alt="Attendance Icon">ATTENDANCE</button>
    </form>

    <!-- Schedule Button 
    <form action="schedule.php" method="post">
        <button class="schedule" type="submit"> <img class="schedule_logo" src="<?php echo htmlspecialchars($schedule_logo_image_path); ?>" alt="Dashboard Icon">SCHEDULE</button>
    </form> -->

    <!-- Payslip Button -->
    <form action="payslip.php" method="post">
        <button class="payslip" type="submit"><img class="payslip_logo" src="<?php echo htmlspecialchars($payslip_logo_image_path); ?>" alt="Payslip Icon">
PAYSLIP</button>
    </form>

    <div>
    <button class="logout-button" onclick="window.location.href='logout.php'">Log Out</button>
    </div>
</div>

<!--main body-->
<div class="main-content">
        <div class="namebar">
            <div class="name-info">
                <h1>Hello, Ms/Mr <?php echo $accountName; ?></h1>
                <h3><?php echo $position; ?></h3>
             <!-- <input type="text" name="employeeNumber" disabled value="<?php echo $employeeNumber; ?>">-->
            </div>
            <?php
    $name_design_image_path = '/phpscript/img/DB Detail Icon (3).png';
    ?>
    <img class="name-design" src="<?php echo htmlspecialchars($name_design_image_path); ?>" alt="Name Design Icon">
        </div>

        <h4 id="attendanceHeader">Attendance</h4>
        
<div class="content-container">
    <div class="attendance-container">
    <div style="height: 370px; width:850px; overflow-y: auto;">
        <table>
            <tr>
                <th onclick="redirectToAttendancePage()" style="cursor: pointer;">Date</th>
                <th onclick="redirectToAttendancePage()" style="cursor: pointer;">Time In</th>
                <th onclick="redirectToAttendancePage()" style="cursor: pointer;">Time Out</th>
                <th onclick="redirectToAttendancePage()" style="cursor: pointer;">Worktime</th>
            </tr>
            <?php
            if ($resultAttendance->num_rows > 0) {
                while ($rowAttendance = $resultAttendance->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowAttendance['Date'] . "</td>";
                    echo "<td>" . $rowAttendance['Time_in'] . "</td>";
                    echo "<td>" . $rowAttendance['Time_out'] . "</td>";
                    echo "<td>" . $rowAttendance['worktime'] . "</td>";
                    echo "</tr>";
                }
            } else {
                for ($i = 0; $i < 6; $i++) { 
                    echo "<tr>";
                    echo "<td colspan='4'></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
    </div>       
        <div class="boxes-container">
            <div class="box-absent">
                <p>Total no. of Hours</p>
                <?php
    $totalhrs_logo_image_path = '/phpscript/img/absences icon.png';
    ?>
    <img class="totalhrs_logo" src="<?php echo htmlspecialchars($totalhrs_logo_image_path); ?>" alt="No. of Hours Icon">
                <p class="totalhrs"><?php echo $hours; ?></p>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToAttendancePage() {
        window.location.href = 'attendance.php';
    }
</script>
</body>
</html>
