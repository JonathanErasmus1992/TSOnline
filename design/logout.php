<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
$title = "Logout";
    include("headerLogOut.php");
?>

    <form action="logout.php" method ="POST">
        <fieldset>
            <legend>Do you wish to save your shopping cart before logging out?</legend>
                <p align="center">
                </br>
                <input type="submit" name="saveAndLogout" value="Save My Shopping Cart and Logout"/>
                </br>
                </br>
                <input type="submit" name="logout" value="Logout"/>
                </p>
        </fieldset>
    </form>

<?php
    if(isset($_POST['saveAndLogout'])){

        //Save shopping cart code to go above over here
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: home.php");
        die();
    }
    else if(isset($_POST['logout'])){
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: home.php");
        die();
    }
?>

<?php
    include("footer.php");
?>
