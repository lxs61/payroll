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
$sqlPayslip_update = "SELECT EmployeeNumber, Totaldeduc, Basicpay, Netpay, Date, Hrs, EmployeeName, Rate, Sss, Pagibig, Phil, Tax, Date_Covered FROM payslip_update WHERE EmployeeNumber = '$empNum'";
$sqlEmployee = "SELECT Position, AccountName, BankAccountNumber FROM employee WHERE EmployeeNumber = '$empNum'";

$resultPayslip_update = $con->query($sqlPayslip_update);
$resultEmployee = $con->query($sqlEmployee);

if ($resultPayslip_update->num_rows > 0) {   
    $rowPayslip_update = $resultPayslip_update->fetch_assoc();
    $basicPay = $rowPayslip_update['Basicpay'];
    $totalDeduc = $rowPayslip_update['Totaldeduc'];
    $netPay = $rowPayslip_update['Netpay'];
    $date = $rowPayslip_update['Date'];
    $hrs = $rowPayslip_update['Hrs'];
    $employeeName = $rowPayslip_update['EmployeeName'];
    $sss = $rowPayslip_update['Sss'];
    $pagibig = $rowPayslip_update['Pagibig'];
    $phil = $rowPayslip_update['Phil'];
    $tax = $rowPayslip_update['Tax'];
    $date_Covered = $rowPayslip_update['Date_Covered'];
    
} else {  
    $basicPay = $totalDeduc = $netPay = $date = $hrs = $employeeName = $sss = $pagibig = $phil = $tax = $date_Covered = "N/A";
}

if ($resultEmployee->num_rows > 0) {   
    $rowEmployee = $resultEmployee->fetch_assoc();
    $position = $rowEmployee['Position'];
    $accountName = $rowEmployee['AccountName']; 
    $bankAccountNumber = $rowEmployee['BankAccountNumber'];
} else {  
    $position = $accountName = $bankAccountNumber = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <link rel="stylesheet" href="/phpscript/css/payslip.css">
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
    height: calc(100vh - 205px);
    position: fixed;
    top: 118px; 
    left: 5px; 
    z-index: 1000;
    margin-left:8px;
    margin-top: 5px; 
    margin-bottom: 50px; 
    padding-bottom: 60px; 
    border-radius: 10px 0px 0px 10px;
}
.main-content {
  
background-color: green;
width: 75.2%; 
height: calc(100vh - 200px);
position: fixed;
top: 118px;
left: 295px; 
z-index: 1000;
margin-top: 5px;
padding-bottom: 55px;
border-radius: 0px 10px 10px 0px;
table-layout: fixed;
border-top-right-radius: 10px;
padding-right: 45px;

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
.attendance,
.schedule,
.logout-button {
        border: none;
    }
    a{
        color: black;
        text-decoration: none;
    }
    .dashboard,
    .attendance,
    .schedule
    {
   margin-left: 17px;
}
.top{
   
    text-align: center;
    margin-bottom: 0px;
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    font-size: 40px;

}
.payslip-form{
    margin-top: 18px;
margin-left: 90px;
border: 5px solid black;    
background-color: white;
width: 800px; 
height: 580px;
}

.mid{
    text-align: center;
    margin-bottom: 5px;
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    
}
.bottom{
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    text-align: center;
    font-size: 20px;
}

        .header {  
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 5px solid black;
    height: 100px;
}

.left-logo {
    width: 80px;
    height: 80px;
    margin-left: 100px;
}

.right-logo {
    width: 80px;
    height: 80px;
    margin-right:100px ;
}
.information1,
.information2,
.information3,
.information4,
.information5
{
    margin-top: 30px;
    margin-left: 20px;  
    margin-bottom: 30px;
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
}
.top-body {
    display: flex;
    flex-direction: column;
    border-bottom: 5px solid black;
    text-size-adjust: 5px;
}

.info-pair {
    display: flex;
    justify-content: space-between;
    height: 20px;
}

.information2
 {
    margin-left: 6px;
    margin-right: auto;
    text-align: center;
 }
.information4 {
    margin-left: 7px;
    margin-right: auto;
    text-align: center;

}
.top-mid-earnings,
.top-mid-amount1,
.top-mid-deduction,
.top-mid-amount2{
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    display: inline; 
    font-size: 15px;
}
.top-mid-earnings{
margin-left: 10px;
}
.top-mid-amount1{
margin-left: 130px;
}
.top-mid-deduction{
margin-left: 130px;
}
.top-mid-amount2{
margin-left: 130px;
}

.top-mid{  
    margin-top: 2px;
    margin-bottom: 2px;
}
.mid-body{
    padding-top: 30px;
    padding-bottom: 30px;
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    border-top: 5px solid black;
}

.sss
{
    margin-top: 10px;
    margin-right: 3%;  
}
.pagibig{
    margin-top: 10px;
    margin-right: 3%;  
}
.philhealth,
.lates,
.absences,
.tax{
    margin-left: 48.1%;
}
.philhealth{
    margin-top: 10px; 
}
.tax{
    margin-bottom: 15px;
}
.basic-pay,
.total-hrs{
    margin-top: 10px;
    margin-left: 20px;
    margin-bottom: 20px;

}
.bottom-mid{
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    border-bottom: 5px solid black;
    border-top: 5px solid black;
}
.bottom-mid-income,
.bottom-mid-deduction{
    display: inline;
}
.bottom-mid-income{
    margin-left: 5px ;
}
.bottom-mid-deduction{
    margin-left: 0px;
}
.netpay,
.inword{
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    font-style: normal;
    margin-left: 20px;
    margin-bottom: 10px;
    margin-top: 49px;
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
    padding-right: 52px;
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
button.payslip{
display: flex;
align-items: center;
background-color: yellow;
border: 6px solid rgb(1, 88, 1);
padding: 10px;
padding-left: 45px;
padding-right: 76px;
border-radius: 10px;
margin-top: 10px;
margin-left: 10px;
margin-right: 10px;
font-size: 20px;
}
.payslip:hover{
background-color: rgb(202, 202, 5);
}
.payslip_logo {
margin-right: 29px;
}
.name{
margin-left: 132px;
}
.employeenumber{
    margin-left: 62px;
}
.position{
    margin-left: 115px;
}
.accno{
    margin-left: 93px;
}
.datecov{
    margin-left: 97px;  
    text-transform: uppercase;
}
.basic{
margin-left: 100px;
}
.Sss{
margin-left:170px;
}
.HRS{
    margin-left:42px;
}
.ibig{
    margin-left: 140px;
}
.PHIL{
    margin-left: 128px;
}
.TAX{
    margin-left: 175px;
}
.income{
    margin-left: 93px;
}
.deducs{
    margin-left: 88px;
}
.net{
    margin-left: 113px;
}
.name,
.employeenumber,
.position,
.accno,
.datecov,
.basic,
.Sss,
.HRS,
.ibig,
.PHIL,
.TAX,
.income,
.deducs,
.net{
    border: none;
    background: none;
    outline: none;
    color: inherit;
    font: inherit;
    
}
.payslip-container{
    margin-left: 40px;
    margin-top: 10px;
}
    </style>
</head>
<body>

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

    <!-- Schedule Button 
    <form action="schedule.php" method="post">
        <button class="schedule" type="submit"> <img class="schedule_logo" src="<?php echo htmlspecialchars($schedule_logo_image_path); ?>" alt="Dashboard Icon">SCHEDULE</button>
    </form> -->

    <!-- Payslip Button -->
    <form action="" method="post">
        <button class="payslip" type="submit"><img class="payslip_logo" src="<?php echo htmlspecialchars($payslip_logo_image_path); ?>" alt="Payslip Icon">
PAYSLIP</button>
    </form>
   
<div>
<button class="logout-button" onclick="window.location.href='logout.php'">Log Out</button>
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
</div>
<!-- Main content -->
<div class="main-content">
    <div class="payslip-container">
    <div class="payslip-form">
        <div class="header">
            <div>
            <?php
    $left_logo_image_path = '/phpscript/img/The_Colegio_de_Montalban_Seal.png';
    ?>
    <img class="left-logo" src="<?php echo htmlspecialchars($left_logo_image_path); ?>" alt="The Colegio de Montalban Seal">
            </div>
            <div>
                <p class="top">Colegio de Montalban</p>
                <p class="mid">Kasiglahan Village, Rodriquez, Phillipines</p>
                <p class="bottom">Payslip for the Month of March 2024</p>
            </div>
            <div>
            <?php
    $right_logo_image_path = '/phpscript/img/MONTALBAN-LOGO.png';
    ?>
    <img class="right-logo" src="<?php echo htmlspecialchars($right_logo_image_path); ?>" alt="MONTALBAN LOGO">
            </div>
        </div>
        <div class="top-body">
    <div class="info-pair">
        <p class="information1">Name <input type="text" class="name" name="accountName" value=": <?php echo $accountName; ?>"></p>
        <p class="information2">Employee Number <input type="text" class="employeenumber" name="empNum" value=": <?php echo $empNum; ?>"></p>
    </div>
    <div class="info-pair">
        <p class="information3">Position <input type="text" class="position" name="position" value=": <?php echo $position; ?>"></p>
        <p class="information4">Date Covered <input type="text" class="datecov" name="date_covered" value=": <?php echo $date_Covered; ?>"></p> 
    </div>
    <p class="information5">Account no <input type="text" class="accno" name="bankAccountNumber" value=": <?php echo $bankAccountNumber; ?>"></p>
</div>
<div class="top-mid">
    <p class="top-mid-earnings">Earnings</p>
    <p class="top-mid-amount1">Amount</p>
    <p class="top-mid-deduction">Deduction</p>
    <p class="top-mid-amount2">Amount</p>
</div>
<div class="mid-body">
    <div class="info-pair">
        <p class="basic-pay">Basic Pay <input type="text" class="basic" name="basicPay" value=": <?php echo $basicPay; ?>"></p>
        <p class="sss">SSS <input type="text" class="Sss" name="sss" value=": <?php echo $sss; ?>"></p>
    </div>
    <div class="info-pair">
        <p class="total-hrs">Total no. of Hours <input type="text" class="HRS" name="hrs" value=": <?php echo $hrs; ?>"></p>
        <p class="pagibig">Pag-ibig <input type="text" class="ibig" name="pagibig" value=": <?php echo $pagibig; ?>"></p>
    </div>
    <p class="philhealth">Philhealth <input type="text" class="PHIL" name="phil" value=": <?php echo $phil; ?>"></p>
    <!--<p class="lates">Lates: </p>-->
    <p class="tax">Tax <input type="text" class="TAX" name="tax" value=": <?php echo $tax; ?>"></p>
</div>
<div class="bottom-mid">
    <p class="bottom-mid-income">Total Income  <input type="text" class="income" name="totalIncome" value=": <?php echo $basicPay; ?>"></p>
    <p class="bottom-mid-deduction">Total Deduction <input type="text" class="deducs" name="totalDeduc" value=": <?php echo $totalDeduc; ?>"></p>
</div>
<div class="bottom-body">
    <p class="netpay">Net Pay <input type="text" class="net" name="netPay" value=": <?php echo $netPay; ?>"></p>
    <!--<p class="inword">In word:</p>-->
</div>
</div>
</body>
</html>
