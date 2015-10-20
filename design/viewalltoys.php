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

    sort($itemList);
    $addItem = array();
?>

    <form action = 'viewalltoys.php' method = 'post'>
        <fieldset>
            <legend>Please click add on the toy/s you wish to purchase</legend>
            <table border="1" cellspacing='5px' cellpadding="7px">
                <tr>
                    <td><strong>Item no.</strong></td>
                    <td align="center"><strong>Item Name</strong></td>
                    <td><strong>Age Group/Category</strong></td>
                    <td><strong>Item Price</strong></td>
                    <td><strong>Amount In Stock</strong></td>
                    <td><strong>Order Amount</strong></td>
                </tr>

                <?php
                foreach ( $itemList as $item )
                {
                    $tmpStringPrice = number_format("{$item->itemPrice}", 2)
                ?>
                <tr>
	          	<td><label><?php echo $item->id; ?></label></td>
			  	<td><label><?php echo $item->itemName; ?></label></td>
			  	<td align='center'><label><?php echo $item->itemCategory; ?></label></td>
			  	<td><label>R <?php echo $tmpStringPrice; ?></label></td>
			  	<td align='center'><label><?php echo $item->amountInStock; ?></label></td>
			  	<td align="center"><input type="number" value="1" name="<?php echo 'amountOrdered_'.$item->id ?>" min="1" max="<?php echo $item->amountInStock; ?>" </td>
			  	<td><input type="submit" value="Add To Cart" name="<?php $clicked[] = $item->id; echo $item->id; ?>" </td>
              	</tr>
              	<?php
                }
                ?>
            </table>
            <?php
            foreach($clicked as $click){
                if(isset($_POST[$click])){
                    //echo "You clicked ".$click;
                    $tmpIndex = 0;
                    if(isset($_SESSION['itemsAdded'])){

                    }
                    if(in_array($click, $_SESSION['itemsAdded']) == false){
                        $_SESSION['itemsAdded'][] = $click;
                        //echo $click;
                        //$tmpItemOrderedAmount = $_POST['amountOrdered_'.$click];
                        $tmpIndex = array_search($click, $_SESSION['itemsAdded']);
                    }
                    else{
                        $tmpIndex = array_search($click, $_SESSION['itemsAdded']);
                    }

                    $_SESSION['amountOrdered_'.$click] = $_POST['amountOrdered_'.$click];

                    //echo "(Item ID: " . $_SESSION['itemsAdded'][$tmpIndex] . " Ordered Amount: " . $_SESSION['amountOrdered_'.$click] . " )";
                    //var_dump($_POST['amountOrdered_'.$click]);

                    /*for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
                        echo "(Item ID: ".$_SESSION['itemsAdded'][$i]." Ordered Amount: ".$_POST['amountOrdered_'.$click]." )";
                        //echo $_POST['amountOrdered_'.$click];
                        /*if ($_SESSION['itemsAdded'][$i] == $click){
                        }
                        echo "(Item ID: ".$_SESSION['itemsAdded'][$i]." Ordered Amount: ".$_POST['amountOrdered_'.$click]." )";
                    }*/
                }
            }
            //var_dump($clicked);
            ?>
            </br>
            <p align="center">When You Wish To Checkout your Order Please click Trolley icon on top right hand corner.</br>Thank You</p>
        </fieldset>
    </form>
<?php
include "footer.php";
?>