<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $curl = curl_init();
    
    $id = $_POST['id'];
    
    $prod = "http://apimonitoring.owtel.com/api/v1/log/" . $id;
    $dev  = "http://test.appmonitoring.com/api/v1/log/" . $id;
    
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => $dev,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: c3b7978e-258d-342a-a102-4b178008ca0c"
        )
    ));
    
    $response = curl_exec($curl);
    $err      = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        
        echo $response;
    }
}