<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */

    $title = "Checkout";
    include "headerCheckout.php";
?>

<?php
    include "../classes/Order.php";
    $tmpOrderObj = new Order();
    $tmpOrderObj->saveOrderCart();
    $tmpInvoice = $tmpOrderObj->checkOutShoppingCartOrder();

    //var_dump($tmpInvoice);
    if(is_null($tmpInvoice)){
        echo "<h4 align='center'>No items in current Order</h4>";
    }else{
        $tmpOrderID = $tmpInvoice['orderID'];
        $tmpTotalPrice = $tmpInvoice['totalPrice'];
        $tmpItemAmount = count($tmpInvoice['orderlines']);
        $tmpInvoiceID = $tmpInvoice['id'];
        $tmpOrderDate = $tmpOrderObj->getOrderDate($_SESSION['order_id']);
        $tmpStringOrderPrice = number_format($tmpTotalPrice, 2);
    }
?>

    <form action="checkout.php" method ="POST">
        <fieldset>
            <legend align="center">Customer Invoice:</legend>
            </br>
            <table align="center" cellspacing='5px' background="../media/receiptbackground.jpg">
                <tr>
                    <td align="center"><?php echo "Invoice No. ".$tmpInvoiceID." Ref-".$tmpInvoiceID."-0TS0-". $tmpOrderID?></td>
                </tr>
                <tr>
                    <td align="center"><?php echo "Number of Different Items Purchased: ".$tmpItemAmount?> </td>
                </tr>
                <tr>
                    <td align="center"><?php echo "Total Price: ".$tmpStringOrderPrice?></td>
                </tr>
                <tr>
                    <td align="center"><?php echo "Order Date: ".$tmpOrderDate?></td>
                </tr>
            </table>
            <p align="center"><input type="submit" name="okCheckout" value="Back To Toys 4 All Home"/></p>
        </fieldset>
    </form>

<?php
    if(isset($_POST['okCheckout'])) {
        session_start();
        $_SESSION['itemsAdded'] = array();
        session_write_close();
        ?>
        <script type="text/javascript">
            window.location.replace("home.php");
        </script>
        <?php
        ?>
        <script type="text/javascript">
            window.location.replace("home.php");
        </script>
        <?php
    }
?>

<?php
    include "footer.php";
?>