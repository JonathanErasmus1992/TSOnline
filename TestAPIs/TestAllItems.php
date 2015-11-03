<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Erasmus
 * Student number: 211112577
 * Date: 10/14/2015
 */
$title = "Test View All Items API";
include "../design/headerSignIn.php";
?>

<?php
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
    if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
        die('error occurred: ' . $json_array->response->errormessage);
    }

    if(isset($json_array)) {
        //var_dump($json_array);

        $itemList = array();

        $itemList = $json_array;

        var_dump($itemList[1]);

        foreach($json_array as $item){
            echo "<pre>{$item->name}  {$item->category}  {$item->price} {$item->quantity}<br/></pre>";
        }
    }

?>

<?php
include "../design/footer.php";
?>