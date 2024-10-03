<?php
function connection(){
   $host =  "localhost";
   $username = "root";
   $password = "";
   $dbname = "payroll_db";

   $con = new  mysqli($host,$username,$password,$dbname);

   if ($con->connect_error) {
    echo $con->connect_error;
   }else{
    return $con;
   }
}
?>
