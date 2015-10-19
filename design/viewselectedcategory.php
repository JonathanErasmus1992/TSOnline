<?php
    $title = "View Selected Category";
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        include "headerLogOut.php";
    }
    else{
        include "headerSignIn.php";
    }
?>
<?php
    echo $_SESSION['selectedCategory'];
?>
    <p>View Selected Category</p>
<?php
include "footer.php";
?>