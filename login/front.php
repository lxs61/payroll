<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Icon Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-Py3y1jLhnElLa57x6tI6qcSQTRrUNFC82rbV+ZuTdIkXt6x3mLAWlmcaxTf2tuvo" crossorigin="anonymous">
    <link rel="stylesheet" href="/phpscript/css/front.css">
    <style>

    </style>
</head>
<body>

<div class="navbar">
    <a class="active" href="#"><i class="fas fa-home"></i></a>
    <a href="#"><i class="fas fa-info-circle"></i></a>
    <a href="#"><i class="fas fa-cog"></i></a>
    <a href="#"><i class="fas fa-envelope"></i></a>
</div>

<div class="content">
    <?php
    $image_path = '/phpscript/img/The_Colegio_de_Montalban_Seal.png';
    ?>
    <img class="cdmlogo" src="<?php echo htmlspecialchars($image_path); ?>" alt="Colegio de Montalban Seal">
    <div class="text-container">
        <h1>CDM<br></h1>
        <h3>PAYROLL SYSTEM</h3>
    </div>
</div>
<div>
<button class="loginbutton" onclick="window.location.href='login.php'">LOG IN</button></a>
</div>

</body>
</html>