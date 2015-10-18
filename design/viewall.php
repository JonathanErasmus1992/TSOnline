<?php
	$title = "View All Toys";
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
	echo "<p>View All Toys</p>";
	/*print_r($itemList);
	 *Prints the array items to screen showing how each item is displayed from the array in a readable way
	 * var_dump($itemList);
	 * Prints the array items to screen showing how the compiler or processor interprets the code*/
	/*foreach($itemList as $item){
		echo $item['id'], " ", $item['itemName'], " ", $item['itemPrice'], " ", $item['amountInStock'];
	}*/
	sort($itemList);
?>

	<form action = '' methods = 'post'>
		<fieldset>
			<legend>Please click add on the toy/s you wish to purchase</legend>
			<table border="1" cellspacing='5px' cellpadding="7px">
				<tr>
					<td><strong>Item no.</strong></td>
					<td align="center"><strong>Item Name</strong></td>
					<td><strong>Item Category</strong></td>
					<td><strong>Item Price</strong></td>
					<td><strong>Amount In Stock</strong></td>
					<td><strong>Order Amount</strong></td>
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
			  	<td align='center'><input type='number' name='amountOrdered' min='1' max='{$item->amountInStock}' </td>
			  	<td><input type='button' id='{$item->id}' value='Add To Cart' name = 'btnAddToCart' + {$item->id} </td>
              	</tr>";
		//echo "{$item->itemName}  {$item->itemPrice}  {$item->amountInStock} <br/>";
	}
?>
			</table>
		</fieldset>
	</form>
<?php
	include "footer.php";
?>