<?php
$title = "Test Register API";
include "../design/headerSignIn.php";
?>

<?php
    //Change username to test this each time
    $service_url = "localhost:8080/register?username=JonahHwdwdill&password=1234&firstname=Jon&lastname=E&idnumber=12121&contact=021";
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

    if(isset($json_array)) {
        if($json_array == true){
            echo "GREEN BLUE YELLOW";
        }
        else{
            echo "GREEN BLUE GREEN";
        }
    }else{
        echo "BLUE BLUE BLUE";
}

?>

<?php
include "../design/footer.php";
?>
