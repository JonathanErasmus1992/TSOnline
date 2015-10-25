<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
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
					include "../classes/Customer.php";
					$tmpCustomerObject = new Customer();
					$tmpCustomerObject->changePassword($_SESSION['customerID'], $password);
					?>
					<script type="text/javascript">
						alert("Your Password Has Been Successfully Changed")
						window.location.replace("myaccount.php");
					</script>
					<?php
				}
			}
			if(isset($_POST['deactivateAccount'])){
			?>
			<script type="text/javascript">
				if(confirm("Are your sure you want to deactivate your Customer Account?")){
					<?php
						//Code to deactivate account
						include "../classes/Customer.php";
						$tmpCustomerObject = new Customer();
						$tmpCustomerObject->deactivateAccount($_SESSION['customerID']);
						session_start();
						$_SESSION = array();
						session_destroy();
					?>
					window.location.replace("home.php");
				}
			</script>
			<?php
			}
			?>
		<pre align="center"><input type='submit' name="changePassword" value='Change My Password'/>           <input type='submit' name="deactivateAccount" value='Deactivate My Account'/></pre>
		</fieldset>
	</form>

<?php
	include "footer.php";
?>