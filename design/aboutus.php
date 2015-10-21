<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
	$title = "About Us";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>
	<h4 align="center">Developed By:<br>Jonathan Erasmus Student Number: 211112577<br>Jarryd Pretorius Student Number: 206155247</h4>
	</br>
	<p align="center"><img src="../media/aboutUS.jpg" </p>

<?php
	include "footer.php";
?>