<?php
$title = "Test Item Category API";
include "../design/headerSignIn.php";
?>

<?php
    //Change Item name each time
    $service_url = "http://localhost:8080/item/category?category=0-3";
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
       var_dump($json_array);
    }

?>

<?php
include "../design/footer.php";
?>