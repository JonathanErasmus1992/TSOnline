<?php
$title = "Test Get Order Date API";
include "../design/headerSignIn.php";
?>

<?php
    //Change username to test this each time
    $service_url = "http://localhost:8080/order/getdate?orderID=2";
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
            echo "GREEN BLUE YELLOW";
        }
        else{
            echo $curl_response;
        }
    }else{
        echo "BLUE BLUE BLUE";
    }

?>

<?php
include "../design/footer.php";
?>
