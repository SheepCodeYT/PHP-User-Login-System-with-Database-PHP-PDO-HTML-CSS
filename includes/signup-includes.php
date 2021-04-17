<?php



if(isset($_POST['signup-submit'])){

    require 'dbHandler-includes.php';
    
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $passwordRepeat = $_POST['psw-repeat'];



    /*ERROR HANDLERS*/
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfild");
        exit();
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=brokenemail");
        exit();
    }

    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=usernamebroken");
        exit();
    }

    elseif($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwortcheckwrong");
        exit();
    }


    else{

        $sql = "SELECT userName FROM users WHERE userName = :username";

        if(!$stmt = $PDOConnectionDatabase->prepare($sql)){
            header("Location: ../signup.php?error=databaseconectionfailed");
            exit();
        } else{
            $stmt = $PDOConnectionDatabase->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $NumberOfResults = $stmt->rowCount();

            if($NumberOfResults > 0){
                header("Location: ../signup.php?error=usernametaken");
                exit();
            }

            if($NumberOfResults == 0){

                $sql = "INSERT INTO users (userName, userEmail, userPassword) VALUES (:username, :email, :hashedPassword)";

                if(!$stmt = $PDOConnectionDatabase->prepare($sql)){
                    header("Location: ../signup.php?error=databaseconectionfailed2");
                    exit();
                } else{

                    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $PDOConnectionDatabase->prepare($sql);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':hashedPassword', $hashedpassword);
                    $stmt->execute();
                    
                    header("Location: ../index.php?signup=success");
                    exit();

                }

            }



        }



    }
    


}









