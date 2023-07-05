<?php 

    session_start();
    include("db.php");

    #Add script that allows adding a given food to database 

    if(isset($_POST["addFood"])){
        $food_name = $_POST["food_name"];
        $food_desc = $_POST["food_desc"];
    
        try{
            $sql = "INSERT INTO food (food_name, food_desc) VALUES ('$food_name', '$food_desc')";
            $conn -> exec($sql);
            
            $action = $_SESSION['user']." added new food - ".$food_name;
            addLog($conn, $_SESSION['user'], $action);
            
            header("Location: food.php");
        }catch(PDOException $e){
            echo $sql."<br>".$e->getMessage();
        }
    }


?>