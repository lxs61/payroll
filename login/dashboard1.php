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
     @import url('https://fonts.googleapis.com/css2?family=Radio+Canada+Big:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap');

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

.logout-button {
    background-color: rgb(222, 241, 222);
    margin-top: 215px;
    margin-left: 11px;
    padding: 8px;
    border-radius: 10px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.attendance,
.schedule,
.payslip,
.logout-button {
    border: none;
}

a {
    color: black;
    text-decoration: none;
}

.payslip,
.attendance,
.schedule {
    margin-left: 17px;
}

.namebar {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: yellow;
    border: 15px solid rgb(1, 88, 1);
    padding: 10px;
    border-radius: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
}

.name-info {
    display: flex;
    flex-direction: column;
}

.name-info h1,
.name-info h3 {
    margin: 0;
}

.name-design {
    margin: 0;
    border: none;
    width: 120px;
    height: 120px;
    border-radius: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
}

h4 {
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    font-size: 20px;
    margin-left: 20px;
    margin-top: 20px;
    margin-bottom: 5px;
}

.content-container {
    display: flex;
    align-items: flex-start;
    padding: 10px;
    width: 50px;
}

table {
    font-family: Arial, sans-serif;
    border: 5px solid lightgray;
    border-collapse: collapse;
    width: 100%;
    background-color: white;
    height: 100%;
    overflow-y: auto;
}

th,
td {
    padding: 20.5px 15px;
    text-align: center;
    font-size: 9px;
}

th {
    background-color: lightgray;
    
}

tr:first-child th {
    border-top: 1px solid lightgray;
}

tr {
    border-bottom: 5px solid lightgray;
}

tr:last-child td {
    border-bottom: none;
}

.box-absent {
    width: 150px;
    height: 80px;
    padding: 10px;
    background-color: white;
    border-radius: 10px;
    border: 5px solid rgb(102, 187, 102);
    text-align: center;
}

.boxes-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-left: 30px;
}

th {
    padding: 10px;
}

.logout-button:hover {
    background-color: rgb(187, 187, 183);
}

.totalhrs_logo {
    width: 30px;
    height: 30px;
    margin-right: 10px;
}

.totalhrs {
    margin-left: 10px;
}

.boxes-container .box-absent .totalhrs_logo {
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
    margin-top: 15px;
}

.boxes-container .box-absent .totalhrs {
    display: inline-block;
    vertical-align: middle;
    margin-top: 15px;
}

.dashboard_logo,
.attendance_logo,
.schedule_logo,
.payslip_logo {
    width: 30px;
    height: 30px;
}

button.dashboard {
    display: flex;
    align-items: center;
    background-color: yellow;
    border: 6px solid rgb(1, 88, 1);
    padding: 10px;
    padding-left: 45px;
    padding-right: 52px;
    border-radius: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-right: 10px;
    font-size: 20px;
}

.dashboard:hover {
    background-color: rgb(202, 202, 5);
}

.dashboard_logo {
    margin-right: 10px;
}

button.attendance {
    display: flex;
    align-items: center;
    background-color: rgb(222, 241, 222);
    padding: 10px;
    padding-left: 45px;
    padding-right: 49.4px;
    border-radius: 10px;
    margin-top: 10px;
    margin-left: 14px;
    margin-right: 10px;
    font-size: 20px;
}

.attendance:hover {
    background-color: rgb(187, 187, 183);
}

.attendance_logo {
    margin-right: 10px;
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
.attendance-container{
    border: 8px solid rgb(138, 199, 138);
    border-radius: 10px;
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
