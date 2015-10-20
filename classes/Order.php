<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/14/2015
 * Time: 8:04 PM
 */
class Order
{
    public function createCustomerOrder($tmpCustomerID){
        $service_url = "http://localhost:8080/order/get?customerID=".$tmpCustomerID;
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
        $service_url = "http://localhost:8080/order/getdate?orderID=".$tmpOrderID;
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
        if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
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
        $service_url = "http://localhost:8080/order/get?customerID=".$tmpCustomerID;
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
        return $json_array;
    }
}