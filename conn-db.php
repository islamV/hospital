<?php
$host="localhost";
$username="root";
$password="";
$dbName="hospital";


try{
    $conn= new PDO("mysql:host=$host;dbname=$dbName",$username,$password);
  // echo "success";
}catch(Exception $e){
    echo $e->getMessage();
    exit();
}