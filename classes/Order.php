<?php

class Order
{
    public function createCustomerOrder($tmpCustomerID){
        $service_url = "http://toystore-jsme.rhcloud.com/order/get?customerID=".$tmpCustomerID;
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

        if(isset($json_array)) {
            //var_dump($json_array);
        }
    }

    public function getOrderDate($tmpOrderID){
        $service_url = "http://toystore-jsme.rhcloud.com/order/getdate?orderID=".$tmpOrderID;
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
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }

        if(isset($curl_response)) {
            if($curl_response == ""){
                //echo "GREEN BLUE YELLOW";
            }
            else{
                //echo $curl_response;
            }
        }else{
            //echo "BLUE BLUE BLUE";
        }

        return $curl_response;
    }

    public function getCustomerOrder($tmpCustomerID){
        $service_url = "http://toystore-jsme.rhcloud.com/order/get?customerID=".$tmpCustomerID;
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
        $json_array = json_decode($curl_response, true, 512, JSON_BIGINT_AS_STRING);
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }

        if(isset($json_array)) {
            //var_dump($json_array);
        }
        return $json_array;
    }

    public function getItemsList(){
        $service_url = "http://toystore-jsme.rhcloud.com/item/all";
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
        $json_array = json_decode($curl_response, true, 512, JSON_BIGINT_AS_STRING);
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }

        if(isset($json_array)) {
            return $json_array;
        }
    }

    public function removeItemFromOrder($tmpOrderID, $tmpItemID){
        $service_url = "http://toystore-jsme.rhcloud.com/orderline/handle?orderID=".$tmpOrderID."&itemID=".
            $tmpItemID."&quantity=0";
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
    }

    public function saveOrderCart(){

        //Create Loop with Session Data to add all the items in cart to orderline etc.
        //Don't need to send any varaibles through can call session in class

        session_start();
        for($i = 0; $i < count($_SESSION['itemsAdded']); $i++){
            $tmpCustomerOrderID = $_SESSION['order_id'];
            $tmpItemAddedID = $_SESSION['itemsAdded'][$i];
            $tmpItemAddedAmount = $_SESSION['amountOrdered_'.$tmpItemAddedID];

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
                //var_dump($curl_response);
            }

            session_write_close();
        }
    }

    public function emptyOrderCart( $tmpOrderID){
        $service_url = "http://toystore-jsme.rhcloud.com/order/delete?orderID=".$tmpOrderID;
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
    }

    public function checkOutShoppingCartOrder(){

        session_start();

        $tmpCustomerID = $_SESSION['customerID'];
        $tmpOrderID = $_SESSION['order_id'];

        $service_url = "http://toystore-jsme.rhcloud.com/order/checkout?orderID=".$tmpOrderID."&customerID=".$tmpCustomerID;
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
        if (isset($json_array->response->status) && $json_array->response->status == 'ERROR') {
            die('error occurred: ' . $json_array->response->errormessage);
        }

        return $json_array;

        session_write_close();
    }
}
?>