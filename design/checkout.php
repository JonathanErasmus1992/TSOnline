<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */

    $title = "Checkout";
    include "headerLogOut.php";
?>

<?php
    include "../classes/Order.php";
    $tmpOrderObj = new Order();
    $tmpInvoice = $tmpOrderObj->checkOutShoppingCartOrder();

    //var_dump($tmpInvoice);
    if(is_null($tmpInvoice)){
        echo "<h4 align='center'>No items in current Order</h4>";
    }else{

    }
?>

<?php
    include "footer.php";
?>