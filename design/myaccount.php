<?php
	$title = "My Account";
	include "headerLogOut.php";

	session_start();
?>
	<form action="myaccount.php" method = "POST">
		<fieldset>
		<legend align="center">My Account Details</legend>
		<table cellspacing= "5px" align="center" >
			<tr>
				<td><label for = "username">Username: </label></td>
				<td><pre>            </pre></td>
				<td><?php echo $_SESSION['username'];?></td>
			</tr>
			<tr>
				<td><label for = "txtPassword">Password: </label></td>
				<td><pre>            </pre></td>
				<td><input type="password" name = "txtPassword" value="<?php echo $_SESSION['password'];?>"</td>
			</tr>
			<tr>
				<td><label for = "txtConfirmPassword">Confirm Password: </label></td>
				<td><pre>            </pre></td>
				<td><input type="password" name = "txtConfirmPassword" value="<?php echo $_SESSION['password'];?>"</td>
			</tr>
			<tr>
				<td><label for = "firstnames">First Names: </label></td>
				<td><pre>            </pre></td>
				<td><?php echo $_SESSION['firstNames'];?></td>
			</tr>
			<tr>
				<td><label for = "lastname">Last Name: </label></td>
				<td><pre>            </pre></td>
				<td><?php echo $_SESSION['lastName'];?></td>
			</tr>
			<tr>
				<td><label for = "contact">Contact: </label></td>
				<td><pre>            </pre></td>
				<td><?php echo $_SESSION['contact'];?></td>
			</tr>
		</table>
			<?php

			$password = "";
			$confirmpassword = "";
			if(isset($_POST['changePassword'])){

				$password = $_POST['txtPassword'];
				$confirmpassword = $_POST['txtConfirmPassword'];

				if($password != $confirmpassword){
					echo "<p align='center'><font color='#FB0307'>*Please ensure that the Password and Confirm Password match and try again.</font></p>";
				}else{
					//Code to save new password. Change Password Service
					$service_url = "http://localhost:8080/customer/changepassword?customerID=".$_SESSION['customerID'].
						"&newPassword=".$password;
					$curl = curl_init($service_url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$curl_response = curl_exec($curl);
					if ($curl_response === false) {
						$info = curl_getinfo($curl);
						curl_close($curl);
						die('error has occurred during curl exec. Additional info: ' . var_export($info));
					}
					curl_close($curl);
					$json_array = array();
					unset($json_array);
					$json_array = json_decode($curl_response, false, 512, JSON_BIGINT_AS_STRING);
					if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
						die('error occurred: ' . $json_array->response->errormessage);
					}

					if(isset($curl_response)) {
						$_SESSION['password'] = $password;
					}
					//Code to save new password. Change Password Service
				}
			}
			if(isset($_POST['deactivateAccount'])){
			?>
			<script type="text/javascript">
				if(confirm("Are your sure you want to deactivate your Customer Account?")){
					window.location.replace("home.php");
				}
			</script>
			<?php
				//Code to deactivate account
				session_start();
				$_SESSION = array();
				session_destroy();
			}
			?>
		<pre align="center"><input type='submit' name="changePassword" value='Change My Password'/>           <input type='submit' name="deactivateAccount" value='Deactivate My Account'/></pre>
		</fieldset>
	</form>

<?php
	include "footer.php";
?>