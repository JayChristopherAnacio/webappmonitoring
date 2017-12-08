<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $curl      = curl_init();
    $column    = $_POST['column'];
    $sortOrder = $_POST['sortOrder'];
    $id        = $_POST['id'];
    
    $prod = "http://apimonitoring.owtel.com/api/v1/process/" . $column;
    $dev  = "http://test.appmonitoring.com/api/v1/process/" . $id . "/" . $column . "/" . $sortOrder;
    //$dev = "http://test.appmonitoring.com/api/v1/process";
    //echo $dev ;
    
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
            "postman-token: fcd07f82-4603-f78b-f7b1-aac33d3a0992"
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