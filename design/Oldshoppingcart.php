<?php
	$title = "Shopping Cart";
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		include "headerLogOut.php";
	}
	else{
		include "headerSignIn.php";
	}
?>

<?php
	include "../classes/Item.php";
	$itemList = array();
	//Use -> instead of . to get class object methods

	$service_url = "http://localhost:8080/item/all";
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

	foreach($json_array as $items){
		//echo "<pre>{$item->name}  {$item->category}  {$item->price} {$item->quantity}<br/></pre>";
		$item = new Item();
		$item->createItem($items->id, $items->name, $items->category, $items->price, $items->quantity );
		$itemList[ ] = $item;
	}
?>

	<form action="Oldshoppingcart.php" method = "POST">
		<fieldset>
			<legend>Please note that you will only be able to checkout your Shopping Cart once Signed In</legend>
			</br>
			<table border="1" cellspacing='5px' cellpadding="7px">
				<tr>
					<td><strong>Item no.</strong></td>
					<td align="center"><strong>Item Name</strong></td>
					<td><strong>Item Category</strong></td>
					<td><strong>Item Price</strong></td>
					<td><strong>Amount Ordered</strong></td>
				</tr>

				<?php
				foreach ( $itemList as $item )
				{
					$tmpStringPrice = number_format("{$item->itemPrice}", 2);
					echo "<tr>
	          	<td><label>{$item->id}</label></td>
			  	<td><label>{$item->itemName}</label></td>
			  	<td><label>{$item->itemCategory}</label></td>
			  	<td><label>R $tmpStringPrice</label></td>
			  	<td align='center'><label>{$item->amountInStock}</label></td>
			  	<td><input type='button' id='{$item->id}' value='Remove One' name = 'removeOne' + {$item->id} </td>
              	<td><input type='button' id='{$item->id}' value='Remove All' name = 'removeAll' + {$item->id} </td>
              	</tr>";
					//echo "{$item->itemName}  {$item->itemPrice}  {$item->amountInStock} <br/>";
				}
				?>
				<tr>
					<td align="center" colspan="2">Shopping Cart Total:</td>
					<td align="right" colspan="5">R </td><!--Add Total amount here-->
				</tr>
			</table>
			</br>

			<p align="center">
			<input type="submit" value="Empty My Shopping Cart" name = "emptyCart"/>
			<input type="submit" value="Save My Shopping Cart" name = "saveCart"/>
			</br>
			</br>
			<input type="submit" value="Checkout" name = "checkoutCart"/>
			</p>

		</fieldset>
	</form>

<?php
	if(isset($_POST['saveCart'])){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){

		}
		else{
			header("Location: notsignedin.php");
		}
	}
	if(isset($_POST['checkoutCart'])){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){

		}
		else{
			header("Location: notsignedin.php");
		}
	}
?>

<?php
	include "footer.php";
?>