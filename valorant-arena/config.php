<?php
// Localhost ke liye updated config
$conn = mysqli_connect("localhost", "root", "", "tectrader");   // <-- yahan tectrader likha hai

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

session_start();
?>