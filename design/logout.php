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

        if(isset($_SESSION['itemsAdded'])){

            include "../classes/Order.php";
            $tmpOrderObj = new Order();
            $tmpOrderObj->saveOrderCart();

            session_start();
            $_SESSION = array();
            session_destroy();

            ?>
            <script type="text/javascript">
                window.location.replace("home.php");
            </script>
            <?php
        }
        else{
            window.location.replace("home.php");
        }

        ?>
        <script type="text/javascript">
            window.location.replace("home.php");
        </script>
        <?php

    }
    else if(isset($_POST['logout'])){
        session_start();
        $_SESSION = array();
        session_destroy();
        ?>
        <script type="text/javascript">
            window.location.replace("home.php");
        </script>
        <?php
    }
?>

<?php
    include("footer.php");
?>
