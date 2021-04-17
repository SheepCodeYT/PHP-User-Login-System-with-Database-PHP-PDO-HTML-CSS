<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sheepcode</title>
  <link href='css/style.css' rel='stylesheet' type='text/css'>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>


<main> 


<h1>Homepage</h1>
<br>


<?php if(!isset($_SESSION['userID'])){  ?>
  <a href="login.php">Login</a>
  <br>
  <a href="signup.php">Signup</a>
<?php } ?>


<?php if(isset($_SESSION['userID'])){  ?>

   <p>You are logged in <?php echo $_SESSION['userName'] ?>! :)</p>

   <form action="includes/logout-includes.php" method="POST">
     <button type="submit" name="logout-submit">Logout</button>
   </form>

<?php } ?>





</main>













































