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
	include "footer.php";
?>