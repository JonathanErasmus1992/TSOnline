<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
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

    $cartPrice = 0;
    $tmpStringCartPrice = 0;

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
    if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
        die('error occurred: ' . $json_array->response->errormessage);
    }

    if(isset($_SESSION['itemsAdded'])){
        foreach($json_array as $items){
            //echo "<pre>{$item->name}  {$item->category}  {$item->price} {$item->quantity}<br/></pre>";
            /*$tmp1 = "";
            $tmpIndex = 0;
            $tmp2 = 0;*/

            if(in_array($items->id, $_SESSION['itemsAdded'])){
                $tmpIndex = array_search($items->id, $_SESSION['itemsAdded']);
                $tmpNumber = $_SESSION['amountOrdered_'.$items->id];
                $tmpTotalPrice = $items->price * $tmpNumber;

                $item = new Item();
                $item->createItem($items->id, $items->name, $items->category, $tmpTotalPrice, $tmpNumber);
                $itemList[ ] = $item;
            }

            /*for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
                $tmp1 = $_SESSION['itemsAdded'][$i];
                //$tmpIndex = array_search($tmp1, $_SESSION['itemsAdded']);
                //$tmp2 = $_SESSION['amountOrdered_'.$tmp1];

                if($items->id == $tmp1){
                    $tmpIndex = array_search($tmp1, $_SESSION['itemsAdded']);
                    $tmp2 = $_SESSION['amountOrdered_'.$tmp1];
                    $tmpTotalPrice = $items->price * $items->quantity;
                    $item = new Item();
                    $item->createItem($items->id, $items->name, $items->category, $tmpTotalPrice, $tmp2);
                    $itemList[ ] = $item;
                }
            }*/
        }
    }
?>

    <form action="ShoppingCart.php" method = "POST">
        <fieldset>
            <legend>Please note that you will only be able to checkout your Shopping Cart once Signed In</legend>
            </br>
            <table border="1" cellspacing='5px' cellpadding="7px">
                <tr>
                    <td><strong>Item no.</strong></td>
                    <td align="center"><strong>Item Name</strong></td>
                    <td><strong>Age Group/Category</strong></td>
                    <td><strong>Item/s Price</strong></td>
                    <td><strong>Amount Ordered</strong></td>
                </tr>

                <?php
                foreach ( $itemList as $item )
                {
                    $cartPrice = $cartPrice + $item->itemPrice;
                    $tmpStringPrice = number_format("{$item->itemPrice}", 2);
                    $tmpStringCartPrice = number_format("{$cartPrice}", 2);

                    ?>
                    <tr>
                        <td><label><?php echo $item->id; ?></label></td>
                        <td><label><?php echo $item->itemName; ?></label></td>
                        <td align='center'><label><?php echo $item->itemCategory; ?></label></td>
                        <td><label>R <?php echo $tmpStringPrice; ?></label></td>
                        <td align='center'><label><?php echo $item->amountInStock; ?></label></td>
                        <td><input type='button' id='{$item->id}' value='Remove One' name = 'removeOne'</td>
                        <td><input type='button' id='{$item->id}' value='Remove All' name = 'removeAll'</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td align="center" colspan="3">Shopping Cart Total:</td>
                    <td align="right" colspan="4">R <?php  echo $tmpStringCartPrice;?></td><!--Add Total amount here-->
                </tr>
            </table>
            </br>

            <p align="center">
                <input type="submit" value="Retrieve My Shopping Cart" name = "retrieveCart"/>
                <input type="submit" value="Empty My Shopping Cart" name = "emptyCart"/>
                <input type="submit" value="Save My Shopping Cart" name = "saveCart"/>
                </br>
                </br>
                <input type="submit" value="Checkout" name = "checkoutCart"/>
            </p>

        </fieldset>
    </form>

<?php
    if(isset($_POST['emptyCart'])){
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){


            include "../classes/Order.php";

            $tmpOrderObj = new Order();

            $tmpOrderObj->emptyOrderCart($_SESSION['order_id']);

            $_SESSION['itemsAdded'] = array();

            ?>
            <script type="text/javascript">
                window.location.replace("ShoppingCart.php");
            </script>
            <?php
        }
        else{
            $_SESSION['itemsAdded'] = array();

            ?>
            <script type="text/javascript">
                window.location.replace("ShoppingCart.php");
            </script>
            <?php
        }
    }

    if(isset($_POST['saveCart'])){
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){

            include "../classes/Order.php";
            $tmpOrderObj = new Order();
            $tmpOrderObj->saveOrderCart();

            ?>
            <script type="text/javascript">
                window.location.replace("ShoppingCart.php");
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                window.location.replace("notsignedin.php");
            </script>
            <?php
        }
    }

    if(isset($_POST['checkoutCart'])){
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){

        }
        else{
            ?>
            <script type="text/javascript">
                window.location.replace("notsignedin.php");
            </script>
            <?php
        }
    }

    if(isset($_POST['retrieveCart'])){
        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
            /*Change values of $_SESSION[itemsAdded] and $_SESSION[amountOrdered_'.tmpAmount] to zero/empty
              Loop through array from service call and add each value retrieved to there respective SESSION variable
             */
            include "../classes/Order.php";
            $tmpOrderObj = new Order();
            $tmpOrder = $tmpOrderObj->getCustomerOrder($_SESSION['customerID']);

            $_SESSION['itemsAdded'] = array();
            //var_dump($tmpOrder);
            $tmpOrderlines = $tmpOrder['orderlines'];
            var_dump($tmpOrder);
            var_dump($tmpOrderlines);

            for($i = 0; $i < count($tmpOrderlines); $i++){
                $tmpID = $tmpOrderlines[$i]['id'];
                $tmpQuantity = $tmpOrderlines[$i]['quantity'];
                $_SESSION['itemsAdded'][] = $tmpID;
                $_SESSION['amountOrdered_'.$tmpID] = $tmpQuantity;
            }

            ?>
            <script type="text/javascript">
                window.location.replace("ShoppingCart.php");
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                window.location.replace("notsignedin.php");
            </script>
            <?php
        }
    }
?>

<?php
    include "footer.php";
?>