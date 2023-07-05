<?php

include("db.php");
require 'PasswordHash.php';
session_start();


#if statement for an event when user press log in button
if(isset($_POST["login"])){
    $login = $_POST["username"];
    $password = $_POST["password"];
    $t_hasher = new PasswordHash(8, FALSE);

    #checks if user exists if not then it creates one
    if(!checkUser($login, $password, $conn, $t_hasher) ){
        createUser($login, $password, $conn, $t_hasher);
    }
}

#Function for checking if user exists in database
function checkUser($email, $password, $conn, $t_hasher){
    try{  
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_username='$email'");
        $stmt -> execute();
        $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) != 0){
            if($t_hasher->CheckPassword($password, $rows[0]['user_password'])){
                $_SESSION['user'] = $email;
                header("Location: food.php");
            }else{
                echo "Wrong password";
            }

            return true;

        }else{
            return false;
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
}

#Function for creating an user
function createUser($login, $password, $conn, $t_hasher){
    try{
        
        $hash = $t_hasher->HashPassword($password);

        $sql = "INSERT INTO users (user_username, user_password) VALUES ('$login', '$hash')";
        $conn -> exec($sql);
        echo "New login added";
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }

}


?>