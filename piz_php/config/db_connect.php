<?php 
$serverName = 'localhost';
$userNmae = 'samuelldmj';
$passWord = 'burning1234567';
$dbname = 'burning_pizza';



//conecting to database
$conn = mysqli_connect($serverName, $userNmae, $passWord, $dbname );

//check connection
if(!$conn){
    die('Connection error: ' . mysqli_connect_error());
}

?>