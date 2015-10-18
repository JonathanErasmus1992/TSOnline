<?php
	$title = "Shopping Cart";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
<p>Shopping Cart</p>
<?php
	include "footer.php";
?>