<?php
    $title = "Test Change Password API";
    include "../design/headerSignIn.php";
?>

<?php
    $service_url = "http://localhost:8080/customer/changepassword?customerID=2&newPassword=12345";
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
    if (isset($json_array->response->status) && $json->response->status == 'ERROR') {
        die('error occurred: ' . $json_array->response->errormessage);
    }

    if(isset($curl_response)) {
        var_dump($curl_response);
    }

?>

<?php
    include "../design/footer.php";
?>