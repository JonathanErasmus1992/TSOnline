<?php
	$title = "Categories";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
<p>Categories</p>
<?php
	include "footer.php";
?>