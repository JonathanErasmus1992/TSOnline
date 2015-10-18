<?php
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

    }
    else if(isset($_POST['logout'])){

    }
?>

<?php
    include("footer.php");
?>
