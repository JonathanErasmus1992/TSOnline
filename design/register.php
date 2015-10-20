<?php
	$title = "Register";
	include "headerSignIn.php";

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
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
            echo "<font color='#FB0307'>*Please fill in all the fields and try again</font>";
        }
        else{
            if($password != $confirmpassword){
                echo "<font color='#FB0307'>*Please ensure that the Password and Confirm Password match and try again.</font>";
                $password = "";
                $confirmpassword = "";
            }
            else{
                $firstnames = str_replace(" ", "%20", $firstnames);
                $service_url = "http://localhost:8080/register?username=".$username."&password=".$password."&firstname=".
                $firstnames."&lastname=".$lastname."&idnumber=".$idnumber."&contact=".$contact;
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

                if(isset($json_array)) {
                    if($json_array == true){
                        header("Location: home.php");
                        die();
                    }
                    else{
                        echo "<font color='#FB0307'>*A Customer with the Username you provided already exists, please enter a different Username and try again.</font>";
                        $username = "";
                    }
                }
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
<p align="center"><input type ='submit' value ='Register New Account' name = 'submit'/></p>
    </fieldset>
</form>
<!-- Username check if the username is unique or not. Service? -->
<?php
	include "footer.php";
?>