<?php
if (!isset($_SESSION)) {
    session_start();
}

include('../connection/connection.php');

$con = connection();

if (!isset($_SESSION['employeeNumber'])) {
    header('Location: login.php');
    exit;
}


$employeeNumber = $_SESSION['employeeNumber'];

$sqlSchedule = "SELECT `Mon_1`, `Mon_2`, `Mon_3`, `Mon_4`, `Mon_5`, `Mon_6`, 
                `Tue_1`, `Tue_2`, `Tue_3`, `Tue_4`, `Tue_5`, `Tue_6`, 
                `Wed_1`, `Wed_2`, `Wed_3`, `Wed_4`, `Wed_5`, `Wed_6`, 
                `Thu_1`, `Thu_2`, `Thu_3`, `Thu_4`, `Thu_5`, `Thu_6`, 
                `Fri_1`, `Fri_2`, `Fri_3`, `Fri_4`, `Fri_5`, `Fri_6`, 
                `Sat_1`, `Sat_2`, `Sat_3`, `Sat_4`, `Sat_5`, `Sat_6`, 
                `Sun_1`, `Sun_2`, `Sun_3`, `Sun_4`, `Sun_5`, `Sun_6` 
                FROM `schedule` WHERE `EmployeeNumber` = '$employeeNumber'";
$resultSchedule = mysqli_query($con, $sqlSchedule);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
   <!-- <link rel="stylesheet" href="/phpscript/css/schedule.css"> -->
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
    width: 1125px;
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
.logout-button {
    background-color: rgb(222, 241, 222);
    margin-top: 155px;
    margin-left: 11px;
    padding: 8px;
    border-radius: 10px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.attendance,
.dashboard,
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
.dashboard {
    margin-left: 17px;
}

.schedule-shortcut {
    width: 95%; 
   
}

.schedule-shortcut table {
    font-family: Arial, sans-serif;
    border: 5px solid lightgray;
    border-collapse: collapse;
    width: 100%; 
    margin-top: 10px;
    background-color: white;
    margin-left: 20px;
    height: 350px;
}

.schedule-shortcut th, 
.schedule-shortcut td {
    padding: 10px 6px; 
    text-align: center;
    font-size: 9px; 
}

.schedule-shortcut th {
    background-color: lightgray; 
}

.schedule-shortcut tr:first-child th {
    border-top: 1px solid lightgray; 
}

.schedule-shortcut tr {
    border-bottom: 5px solid lightgray; 
}

.schedule-shortcut tr:last-child td {
    border-bottom: none; 
}

p {
    font-size: 40px;
    margin-top: 10px;
    margin-left: 25px;
    font-family: "Roboto", sans-serif;
    font-weight: 400;
    font-style: normal; 
}
.logo-container img {
height: 60px; 
width: 60px; 
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
.user {
    background-color: yellow; 
    border: 6px solid rgb(1, 88, 1); 
    padding: 10px; 
    border-radius: 10px; 
    margin-top: 10px; 
    margin-left: 10px;
    margin-right: 10px;
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
.logout-button:hover{
    background-color: rgb(187, 187, 183);
}
.dashboard_logo,
.attendance_logo,
.schedule_logo,
.payslip_logo{
width: 30px;
height: 30px ;
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
background-color: yellow;
border: 6px solid rgb(1, 88, 1);
padding: 10px;
padding-left: 45px;
padding-right: 58px;
border-radius: 10px;
margin-top: 10px;
margin-left: 10px;
margin-right: 10px;
font-size: 20px;
}
.schedule:hover{
background-color: rgb(202, 202, 5);
}
.schedule_logo {
margin-right: 21px;
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
    <form action="attendance.php" method="post">
        <button class="attendance" type="submit"> <img class="attendance_logo" src="<?php echo htmlspecialchars($attendance_logo_image_path); ?>" alt="Attendance Icon">ATTENDANCE</button>
    </form>

    <!-- Schedule Button -->
    <form action="" method="post">
        <button class="schedule" type="submit"> <img class="schedule_logo" src="<?php echo htmlspecialchars($schedule_logo_image_path); ?>" alt="Dashboard Icon">SCHEDULE</button>
    </form>

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
    <p>Schedule</p>
    <div class="schedule-shortcut">
        <table>
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
            <?php

            $rowCount = mysqli_num_rows($resultSchedule);

            if ($rowCount > 0) {
                $rowSchedule = mysqli_fetch_assoc($resultSchedule);

                for ($i = 1; $i <= 6; $i++) {
                    echo "<tr>";
                    echo "<td>" . $rowSchedule['Mon_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Tue_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Wed_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Thu_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Fri_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Sat_' . $i] . "</td>";
                    echo "<td>" . $rowSchedule['Sun_' . $i] . "</td>";
                    echo "</tr>";
                }
            } else {
                
                for ($i = 0; $i < 6; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < 7; $j++) {
                        echo "<td>&nbsp;</td>";
                    }
                    echo "</tr>";
                }
            }

            ?>
        </table>
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
            <h3>PAYROLL SYSTEM</h3>
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
