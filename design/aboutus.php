<?php
	$title = "About Us";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
<p>About Us</p>
<?php
	include "footer.php";
?>