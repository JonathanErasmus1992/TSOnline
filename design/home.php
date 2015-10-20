<?php
	$title = "Home";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>

	<p>Home</p>

<?php
	for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
		$tmp1 = $_SESSION['itemsAdded'][$i];
		$tmpIndex = array_search($tmp1, $_SESSION['itemsAdded']);
		$tmp2 = $_SESSION['amountOrdered_'.$tmp1];
		echo "(Item ID: ".$tmp1." Ordered Amount: ".$tmp2." )";
	}
?>

<?php
	include "footer.php";
?>