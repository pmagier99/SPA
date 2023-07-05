<?php

include("db.php");
session_start();


$action = $_GET['action'];
$id = $_GET['id'];

#Switch action to determine which action has been clicked by the user
switch($action){
    case "delete":
        
        $sql = "DELETE FROM food WHERE id=$id";
        $conn->exec($sql);
        
        $actionMsg = $_SESSION['user']." deleted food";
        addLog($conn, $_SESSION['user'], $actionMsg);

        header("Location: food.php");

        break;

    case "view":
        
        $stmt = $conn->prepare("SELECT * FROM food WHERE id=$id");
        $stmt -> execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo 'FOOD NAME: '.$rows[0]['food_name'].'<br>';
        echo 'FOOD DESCRIPTION: '.$rows[0]['food_desc'].'<br>';
        echo '<a href=food.php>go back</a>';

        $actionMsg = $_SESSION['user']." displayed food ".$rows[0]['food_name'];
        addLog($conn, $_SESSION['user'], $actionMsg);
    
        break;
}

?>