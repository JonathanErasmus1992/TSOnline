<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */

    $title = "User Not Signed In";
    include "headerSignIn.php";
?>

<?php
    if(isset($_POST['signIn'])){
        header("Location: signin.php");
    }
    if(isset($_POST['registerCust'])){
        header("Location: register.php");
    }
 ?>

<form action="notsignedin.php" method="POST">
    <p><h4 align="center"><font color='#FB0307'>********Customer Not Signed In********</font></h4></p>
    <p align="center">To Be able to Save A Shopping Cart or Checkout a Shopping Cart, user must be a registered customer and signed into there account</p>
    <p align="center">If you are a Registered Customer please click the Sign In button to continue: </br></br> <input type="submit" name="signIn" value="Sign In To My Account"/> </p>
    <p align="center">If you are not a Registered Customer please click the Register Customer button to continue: </br></br> <input type="submit" name="registerCust" value="Register New Customer"/></p>
</form>


<?php
    include "footer.php";
?>