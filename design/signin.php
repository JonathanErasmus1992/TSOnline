<?php
	$title = "Sign In";
	include("headerSignIn.php");
?>

<?php
	session_start();
	$username = "";
	$password = "";
	if(isset($_POST['submit'])) {

		$username = $_POST['txtUsername'];
		$password = $_POST['txtPassword'];

		if (empty($username) && empty($password)) {
			echo "<font color='#FB0307'>Please fill in both your username and password</font>";
			$username = "";
			$password = "";
		} else if (!empty($username) && empty($password)) {
			echo "<font color='#FB0307'>Please fill in your password</font>";
			$password = "";
		} else if (empty($username) && !empty($password)) {
			echo "<font color='#FB0307'>Please fill in your username</font>";
			$username = "";
		} else {
			if ($username != "JonE" && $password != "1234") {
				echo "<font color='#FB0307'>Please make sure that both your username and password are correct</font>";
				$username = "";
				$password = "";
			} else if ($username != "JonE" && $password == "1234") {
				echo "<font color='#FB0307'>Please make sure that the username you provided is correct</font>";
				$password = "";
			} else if ($username == "JonE" && $password != "1234") {
				echo "<font color='#FB0307'>Please make sure that the password you provided is correct</font>";
				$username = "";
			} else if ($username == "JonE" && $password == "1234") {
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				header("Location: home.php");
			}
		}
	}
?>
	<form action="signin.php" method ="POST">
		<fieldset>
			<legend>Please fill in your Username and Password to Sign In</legend>
			<table cellspacing='5px'>
				<tr>
					<td><label for='username'>Username: </label></td>
					<td><input type="text" id="txtUsername" name="txtUsername" value="<?php echo $username;?>" </td>
				</tr>
				<tr>
					<td><label for='password'>Password: </label></td>
					<td><input type="password" id="txtPassword" name="txtPassword" value="<?php echo $password;?>"/></td>
				</tr>
			</table>
			<pre>                                                           <input type='submit' name="submit" value='Sign In To My Account'/></pre>
		</fieldset>
	</form>
<?php
	include("footer.php");
?>