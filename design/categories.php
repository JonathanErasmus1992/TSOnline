<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
	$title = "Categories";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}

?>

	<form action="categories.php" method = "POST">
		<fieldset>
			<legend>Please note that you will only be able to checkout your Shopping Cart once Signed In</legend>
			</br>
			<table align="center" border="1" cellspacing='5px' cellpadding="7px">
				<tr>
					<td><input type="image" src="../media/images.jpg" value="cat1" name = "cat1"/></td>
				</tr>
				<tr>
					<td><input type="image" src="../media/images2.jpg" value="cat2" name = "cat2"/></td>
				</tr>
				<tr>
					<td><input type="image" src="../media/images3.jpg" value="cat3" name = "cat3"/></td>
				</tr>
				<tr>
					<td><input type="image" src="../media/images4.jpg" value="cat4" name = "cat4"/></td>
				</tr>
			</table>
			</br>
		</fieldset>
	</form>

<?php
	//Research compatibility with old browsers. The select by Category option does not work in older browsers version beside Chrome
	if(isset($_POST['cat1'])){
		$_SESSION['selectedCategory'] = "0-3";
		echo "BLUE";
		?>
			<script type="text/javascript">
				window.location.replace("viewselectedcategory.php");
			</script>
		<?php
	}
	if(isset($_POST['cat2'])){
		$_SESSION['selectedCategory'] = "4-9";
		echo "YELLOW";
		?>
			<script type="text/javascript">
				window.location.replace("viewselectedcategory.php");
			</script>
		<?php
	}
	if(isset($_POST['cat3'])){
		$_SESSION['selectedCategory'] = "10-13 or Older";
		echo "PURPLE";
		?>
			<script type="text/javascript">
				window.location.replace("viewselectedcategory.php");
			</script>
		<?php
	}
	if(isset($_POST['cat4'])){
		$_SESSION['selectedCategory'] = "Consoles and Games";
		echo "RED";
	?>
			<script type="text/javascript">
				window.location.replace("viewselectedcategory.php");
			</script>
	<?php
	}
?>

<?php
	include "footer.php";
?>