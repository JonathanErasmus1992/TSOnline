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
			echo "<font color='#FB0307'>*Please fill in both your username and password</font>";
			$username = "";
			$password = "";
		} else if (!empty($username) && empty($password)) {
			echo "<font color='#FB0307'>*Please fill in your password</font>";
			$password = "";
		} else if (empty($username) && !empty($password)) {
			echo "<font color='#FB0307'>*Please fill in your username</font>";
			$username = "";
		} else {
			$service_url = "http://localhost:8080/login?username=".$username."&password=".$password;
			$curl = curl_init($service_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$curl_response = curl_exec($curl);
			if ($curl_response === false) {
				$info = curl_getinfo($curl);
				curl_close($curl);
				die('error has occurred during curl exec. Additional info: ' . var_export($info));
			}
			curl_close($curl);
			$json_array = json_decode($curl_response, true, 512, JSON_BIGINT_AS_STRING);
			if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
				die('error occurred: ' . $json->response->errormessage);
			}

			if(isset($json_array)){
				$_SESSION['customerID'] = $json_array['id'];
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['IDNumber'] = $json_array['idNumber'];
				$_SESSION['firstNames'] = $json_array['firstName'];
				$_SESSION['lastName'] = $json_array['lastName'];
				$_SESSION['IDNumber'] = $json_array['idNumber'];
				$_SESSION['contact'] = $json_array['contact'];


				//$currentOrder = 0;

				$tmpArray = $json_array['orders'];
				$tmpOrderID = "";

				for($i = 0; $i < count($tmpArray); $i++){
					$tmp1 = $tmpArray[$i]['id'];
					$tmp2 = true;
					$tmp2 = $tmpArray[$i]['checkout'];
					if($tmp2 == false){
						$tmpOrderID = $tmp1;
					}
				}

				$_SESSION['order_id'] = $tmpOrderID;

				header("Location: home.php");
				die();
			}else{
				echo "<font color='#FB0307'>*Please ensure that the credentials you provided are correct and try again.</font>";
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
			<p align="center"><input type='submit' name="submit" value='Sign In To My Account'/></p>
		</fieldset>
	</form>
<?php
	include("footer.php");
?>