<?php
	$title = "View Purchase History";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
<p>Purchase History</p>
<?php
	include "footer.php";
?>