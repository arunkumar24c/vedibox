<?php
/*Database connection*/
//error_reporting(0);

ob_start();
session_start();



$host = "localhost";
$user  = "root";
$password =  "";
$yeshauldatabase = "emailerlonstar";

define("DBHost", "localhost");
define("DBUser", "lonestar_mailuse");
define("DBPassword", "@db#7iQXM*wn");
define("Databse", "lonestar_automail");

$yeshaul_con = new mysqli($host, $user, $password, $yeshauldatabase);
if($yeshaul_con->connect_errno > 0)
{
    die('Unable to connect to database' . $yeshaul_con->connect_error);
}
else
{
   
}

date_default_timezone_set("Asia/Kolkata");
date_default_timezone_get();
 

?>
