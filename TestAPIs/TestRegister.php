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
    $json_array = json_decode($curl_response);
    if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
        die('error occurred: ' . $json_array->response->errormessage);
    }

    if(isset($curl_response)) {
        if($curl_response == true){
            echo "GREEN BLUE YELLOW";
            echo $curl_response;
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
