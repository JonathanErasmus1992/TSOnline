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
    /*print_r($itemList);
     *Prints the array items to screen showing how each item is displayed from the array in a readable way
     * var_dump($itemList);
     * Prints the array items to screen showing how the compiler or processor interprets the code*/
    /*foreach($itemList as $item){
        echo $item['id'], " ", $item['itemName'], " ", $item['itemPrice'], " ", $item['amountInStock'];
    }*/

    sort($itemList);
?>

    <form action = '' method = 'post'>
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
			  	<td align='center'><label>Ages: {$item->itemCategory}</label></td>
			  	<td><label>R $tmpStringPrice</label></td>
			  	<td align='center'><label>{$item->amountInStock}</label></td>
			  	<td align='center'><input type='number' value='1' name='amountOrdered' min='1' max='{$item->amountInStock}' </td>
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