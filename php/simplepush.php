<?php

function sendMessageToPhone($deviceToken, $collapseKey, $messageText, $yourKey) {
    echo "DeviceToken:".$deviceToken."Key:".$collapseKey."Message:".$messageText
            ."API Key:".$yourKey."Response"."<br/>";

    $headers = array('Authorization:key=' . $yourKey);
    $data = array(
        'registration_id' => $deviceToken,
        'collapse_key' => $collapseKey,
        'data.message' => $messageText);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
    if ($headers)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    var_dump($response);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);    
    if (curl_errno($ch)) {
        return false;
    }
    if ($httpCode != 200) {
        return false;
    }
    curl_close($ch);
    return $response;
}

$yourKey = "YOURKEY";
$deviceToken = "REGISTERED_ID";
$collapseKey = "COLLAPSE_KEY";
$messageText = "MESSAGE";
echo sendMessageToPhone($deviceToken, $collapseKey, $messageText, $yourKey);
?>
