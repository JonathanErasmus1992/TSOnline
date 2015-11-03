<?php

/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
    $title = "Test Add Item To Orderline API";
    include "../design/headerSignIn.php";
?>

<?php
//Create Loop with Session Data to add all the items in cart to orderline etc.
//Don't need to send any varaibles through can call session in class

    session_start();
    for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
        $tmpCustomerOrderID = $_SESSION['order_id'];
        $tmpItemAddedID = $_SESSION['itemsAdded'][$i];
        $tmpItemAddedAmount = $_SESSION['amountOrdered_'.$tmpItemAddedID];

        echo "Item ID: ".$tmpItemAddedID." Amount Ordered: ".$tmpItemAddedAmount;
        echo "</br>";

        $service_url = "http://toystore-jsme.rhcloud.com/orderline/handle?orderID=".$tmpCustomerOrderID."&itemID=".
            $tmpItemAddedID."&quantity=".$tmpItemAddedAmount;
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
        if(isset($curl_response)) {
            var_dump($curl_response);
        }
}

?>

<?php
    include "../design/footer.php";
?>