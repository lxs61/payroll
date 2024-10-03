<?php
session_start();

if (!isset($_SESSION['employeeNumber'])) {
    header("Location: login.php");
    exit;
}

$employeeNumber = $_SESSION['employeeNumber'];
include('../connection/connection.php');
$con = connection();

$empNum = "$employeeNumber";
$sql = "SELECT AccountName FROM employee WHERE employeeNumber = '$empNum'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $accountName = $row['AccountName'];
} else {
    $accountName = "Unknown";
}

$sqlAttendance = "SELECT `Date`, `Time_in`, `Time_out`, `worktime` FROM `attendance` WHERE `EmployeeNumber` = '$employeeNumber'";
$resultAttendance = $con->query($sqlAttendance);

if (!$resultAttendance) {
    die("Query failed: " . $con->error);
}
$numRows = 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <!--<link rel="stylesheet" href="/phpscript/css/attendance.css"> -->
    
</head>
<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

body, h1, p {
    margin: 0;
}

.navbar {
    overflow: hidden;
    background-color: green;
    margin: 0;
    padding: 0;
    height: 110px;
    display: flex;
    align-items: center; 
    justify-content: space-between; 
    padding-left: 20px;
    padding-right: 20px; 
}

.logo {
    height: 100px;
    width: 100px;
}

.nav-content {
    display: flex;
    align-items: center;
}

.text-container {
    color: white;
    margin-top: 30px;
    margin-left: 20px; 
}

h1 {
    font-size: 50px;
    font-family: "Roboto", sans-serif;
    font-weight: 900;
    font-style: normal;
}

h3 {
    font-size: 30px;
    margin-top: 0;
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal;
}

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
    border-radius: 10px 0px 0px 10px;
    
}

.main-content {
    background-color: green;
    width: 1095px;
    height: calc(100vh - 180px);
    position: fixed;
    top: 118px;
    left: 260px; 
    z-index: 1000; 
    margin-top: 5px; 
    margin-bottom: 20px; 
    padding-bottom: 35px; 
    border-radius: 0px 10px 10px 0px;
    margin-left: 40px;
    padding-right: 20px;
    width: calc(100% - 23.5%);
   
}

.user {
    background-color: yellow; 
    border: 6px solid rgb(1, 88, 1); 
    padding: 10px; 
    border-radius: 10px; 
    margin-top: 10px; 
    margin-left: 10px;
    margin-right: 10px;
}

.user-pic {
    margin: 0; 
    border: none; 
    width: 110px; 
    height: 110px; 
    border-radius: 10px; 
    padding-top: 10px;
    padding-bottom: 10px;
}

.logout-button{
    background-color:rgb(222, 241, 222);
    margin-top: 215px;
    margin-left: 11px;
    padding: 8px;
    border-radius: 10px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.dashboard,
.schedule,
.payslip,
.logout-button {
    border: none;
}

a {
    color: black;
    text-decoration: none;
}

.dashboard,
.payslip,
.schedule {
    margin-left: 17px;
}

.attendance-shortcut {
    width: 105.3%; 
    height: 100%; 
    overflow-y: auto; 
}   
.attendance-shortcut::-webkit-scrollbar {
    display: none;
}
.attendance-shortcut table {
    font-family: Arial, sans-serif;
    border: 5px solid lightgray;
    border-collapse: collapse;
    width: 95%; 
    background-color: white;
    table-layout: fixed; 
    margin-top: 20  px;
}
.attendance-shortcut th, 
.attendance-shortcut td {
    padding: 22px; 
    text-align: center;
    font-size: 14px; 
    word-wrap: break-word;
}

.attendance-shortcut th {
    background-color: lightgray; 
}


.attendance-shortcut tr:first-child th {
    border-top: 1px solid lightgray; 
}

.attendance-shortcut tr {
    border-bottom: 5px solid lightgray; 
}

.attendance-shortcut tr:last-child td {
    border-bottom: none; 
}

p {
    color: rgb(255, 255, 255) ;
    font-size: 40px;
    margin-top: 10px;
    margin-left: 25px;
    font-family: "Roboto", sans-serif;
    font-weight: 550;
    font-style: normal; 
}

.logout-button:hover {
    background-color: rgb(187, 187, 183);
}

.dashboard_logo,
.attendance_logo,
.schedule_logo,
.payslip_logo {
    width: 30px;
    height: 30px ;
}

button.payslip {
    display: flex;
    align-items: center;
    background-color: rgb(222, 241, 222);
    padding: 10px; 
    padding-left: 45px;
    padding-right: 80px;
    border-radius: 10px; 
    margin-top: 10px;
    margin-left: 14px;
    margin-right: 10px;
    font-size: 20px;
}

.payslip:hover {
    background-color: rgb(187, 187, 183);
}

.payslip_logo {
    margin-right: 32px; 
}

button.schedule {
    display: flex;
    align-items: center;
    background-color: rgb(222, 241, 222);
    padding: 10px; 
    padding-left: 45px;
    padding-right: 64px;
    border-radius: 10px; 
    margin-top: 10px;
    margin-left: 14px;
    margin-right: 10px;
    font-size: 20px;
}

.schedule:hover {
    background-color: rgb(187, 187, 183);
}

.schedule_logo {
    margin-right: 20px; 
}

button.dashboard {
    display: flex;
    align-items: center;
    background-color: rgb(222, 241, 222);
    padding: 10px; 
    padding-left: 49.4px;
    padding-right: 54px;
    border-radius: 10px; 
    margin-top: 10px;
    margin-left: 14px;
    margin-right: 10px;
    font-size: 20px;
}

.dashboard:hover {
    background-color: rgb(187, 187, 183);
}

.dashboard_logo {
    margin-right: 10px;
}

button.attendance {
    display: flex;
    align-items: center;
    background-color: yellow;
    border: 6px solid rgb(1, 88, 1);
    padding: 10px;
    padding-left: 45px;
    padding-right: 45px;
    border-radius: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    font-size: 20px;
}

.attendance:hover {
    background-color: rgb(202, 202, 5);
}

.attendance_logo {
    margin-right: 10px;
}
.attendance-container{
    margin-top: 11px;
    border: 8px solid rgb(138, 199, 138);
    border-radius: 10px;
    width: 95%; 
    height: 520px;
    margin-left: 20px;
}

    </style>
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
    <form action="dashboard1.php" method="post">
        <button class="dashboard" type="submit"> <img class="dashboard_logo" src="<?php echo htmlspecialchars($totalhrs_logo_image_path); ?>" alt="Dashboard Icon">DASHBOARD</button>
    </form>

    <!-- Attendance Button -->
    <form action="" method="post">
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

<!-- Main content -->
<div class="main-content">
    <p>Attendance</p>
    <div class="attendance-container">
    <div class="attendance-shortcut">
    <table>
        <tr>
            <th>Date</th>
            <th>Time in</th>
            <th>Time out</th>
            <th>Worktime</th>
        </tr>
        <?php
        $rowCount = 0;
        while ($rowAttendance = $resultAttendance->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $rowAttendance['Date'] . "</td>";
            echo "<td>" . $rowAttendance['Time_in'] . "</td>";
            echo "<td>" . $rowAttendance['Time_out'] . "</td>";
            echo "<td>" . $rowAttendance['worktime'] . "</td>";
            echo "</tr>";
            $rowCount++;
        }

        $remainingRows = max(0, $numRows - $rowCount);
        for ($i = 0; $i < $remainingRows; $i++) {
            echo "<tr><td></td><td></td><td></td><td></td></tr>";
        }
        ?>
    </table>
</div>
</div>
</div>
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

</body>
</html>
