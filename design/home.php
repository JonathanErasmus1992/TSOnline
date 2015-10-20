<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
	$title = "Home";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
	<p align="center"><img src="../media/untitlehome.jpg"/></p>
<?php
	/*for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
		$tmp1 = $_SESSION['itemsAdded'][$i];
		$tmpIndex = array_search($tmp1, $_SESSION['itemsAdded']);
		$tmp2 = $_SESSION['amountOrdered_'.$tmp1];
		echo "(Item ID: ".$tmp1." Ordered Amount: ".$tmp2." )";
	}*/
?>

<?php
	include "footer.php";
?>