<?php

include("db.php");
session_start();

#Edit script that allows edting a given food in database 
if(isset($_POST["editFood"])){
    $food_id = $_POST["food_id"];
    $food_name = $_POST["food_name"];
    $food_desc = $_POST["food_desc"];

    try{

        $sql = "UPDATE food SET food_name='$food_name', food_desc='$food_desc' WHERE id=$food_id";
    
        $stmt = $conn -> prepare($sql);
        $stmt->execute();

        $action = $_SESSION['user']." updated food to ".$food_name;
        addLog($conn, $_SESSION['user'], $action);

        header("Location: food.php");
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }
    


}


?>