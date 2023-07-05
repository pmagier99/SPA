<?php 

#Connecting to a database
$servername = "localhost";
$username = "root";
$password = "root";
$dbName = "db";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: " . $e -> getMessage();
}

#Function that allows adding a log of event every time when it is called
function addLog($conn, $user, $action){
    $date = date("Y.m.d");

    try{
        $sql = "INSERT INTO logs (logs_date, logs_author, logs_action) VALUES ('$date', '$user', '$action')";
        $conn -> exec($sql);
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }
    
}

?>