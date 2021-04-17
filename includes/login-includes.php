<?php



if(!isset($_POST['login-submit'])){
    header("Location: ../signup.php?error");
    exit();
}


if(isset($_POST['login-submit'])){
    
    require 'dbHandler-includes.php';

    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty($username) || empty($password)){
        header("Location: ../signup.php?error=emptyfild");
        exit();
    }


    if(isset($_POST['username']) && isset($_POST['password'])){

        $sql = "SELECT * FROM users WHERE userName = :username;";
        $stmt = $PDOConnectionDatabase->prepare($sql);
        $stmt->bindParam(':username', $username);

        if($stmt->execute()){
            if(($row = $stmt->fetch())){

                $PasswordVerify = password_verify($password, $row['userPassword']);

                if($PasswordVerify == false){
                    header("Location: ../signup.php?error=wrongpassword");
                    exit();
                }

                if($PasswordVerify == true){
                    session_start();

                    $_SESSION['userID'] = $row['ID_user'];
                    $_SESSION['userName'] = $row['userName'];

                    header("Location: ../index.php?successlogin");
                    exit();

                }



            }
        }



    }




}















