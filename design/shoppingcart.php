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
	$item1 = new Item();
	$item1->createItem("1", "Woody Doll", "Ages 0 - 3", 180.50, 5);
	$item2 = new Item();
	$item2->createItem("2", "Transformer Bumble Bee", "Ages 8 - 12", 149.50, 3);
	$item3 = new Item();
	$item3->createItem("3", "Hot Wheels Set", "Ages 4 - 7", 75.00, 1);
	$itemList[ ] = $item1;
	$itemList[ ] = $item2;
	$itemList[ ] = $item3;

	sort($itemList);
?>

	<form action="shoppingcart.php" method = "POST">
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