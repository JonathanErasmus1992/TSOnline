<?php
	$title = "Register";
	include "headerSignIn.php";
?>

<?php
        $username = "";
        $password = "";
        $confirmpassword = "";
        $idnumber = "";
        $firstnames = "";
        $lastname = "";
        $contact = "";
    if(isset($_POST['submit'])){
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $confirmpassword = $_POST['txtConfirmPassword'];
        $idnumber = $_POST['txtIDNumber'];
        $firstnames = $_POST['txtFirstnames'];
        $lastname = $_POST['txtLastname'];
        $contact = $_POST['txtContact'];

        if(empty($username) || empty($password) || empty($confirmpassword) || empty($idnumber)
        || empty($firstnames) || empty($lastname) || empty($password)){
            echo "<font color='#FB0307'>Please fill in all the fields and try again</font>";
        }
        else{
            if($password != $confirmpassword){
                echo "<font color='#FB0307'>Please ensure that the Password and Confirm Password match and try again</font>";
                $password = "";
                $confirmpassword = "";
            }
            else{
                echo "<font color='lime'>New Customer Successfully Created</font>";
            }
        }
    }
?>

<form action = 'register.php' method = 'POST'>
	<fieldset>
    	<legend>Please fill in the below to Register an Account</legend>
		<table cellspacing='5px'>
	<tr>
    	<td><label for = 'username'>Username: </label> </td>
        <td><input type = "text" name = "txtUsername" value="<?php echo $username;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'password'>Password: </label> </td>
        <td><input type = "password" name = "txtPassword" value="<?php echo $password;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'confirmpassword'>Confirm Password: </label> </td>
        <td><input type = "password" name = "txtConfirmPassword" value="<?php echo $confirmpassword;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'idnumber'>ID Number: </label>  </td>
        <td><input type = "text" name = "txtIDNumber" value="<?php echo $idnumber;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'firstnames'>First Names: </label> </td>
        <td><input type = "text" name = "txtFirstnames" value="<?php echo $firstnames;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'lastname'>Lastname: </label>  </td>
        <td><input type = "text" name = "txtLastname" value="<?php echo $lastname;?>"/><font color='#FB0307'>*</font></td>
    </tr>
    <tr>
    	<td><label for = 'contact'>Contact: </label>  </td>
        <td><input type = "text" name = "txtContact" value="<?php echo $contact;?>"/></td>
    </tr>
</table>
<pre>                                         <input type ='submit' value ='Register New Account' name = 'submit'/></pre>
    </fieldset>
</form>
<!-- Username check if the username is unique or not. Service? -->
<?php
	include "footer.php";
?>