<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('config.php');
   
    //Array to store validation errors
    $errmsg_arr = array();
    
    //Validation error flag
    $errflag = false;

//Connect to mysql server
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Failed to connect to server: ' . mysqli_error());
}

//Select database
$db = mysqli_select_db($link, DB_DATABASE);
if (!$db) {
    die("Unable to select database");
}

$qry="SELECT * FROM pizzat";

$result=mysqli_fetch_all(mysqli_query($link, $qry));

foreach ($result as $pizza)
echo "$pizza[1]<br>";

exit;
?>