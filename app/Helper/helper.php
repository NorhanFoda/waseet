<?php

function payRequest($cost){
    
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8ac7a4c9706822c7017070da753b0eec" .
                "&amount=$cost" .
                "&merchantTransactionId=" . auth()->user()->id .
                "&customer.email=" . auth()->user()->email . 
                // "&billing.country=SA" .
                // "&billing.state=Riyadh" .
                // "&billing.city=Riyadh" .
                // "&billing.street1=Oliyah" .
                // "&billing.postcode=00966" .
                // "&customer.givenName=hussamadin" .
                // "&customer.surname=abushelha" .
                "&currency=SAR" .
                "&testMode=EXTERNAL" .
                "&paymentType=DB";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjZGE0Yzk3MmMyYWY1YjAxNzJlNTQyYjY3YzYxMWR8cHRZNHlNRlFqaw=='));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if(curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    return $responseData;
}