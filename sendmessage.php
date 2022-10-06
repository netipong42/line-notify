<?php
session_start();

$api_url = 'https://notify-api.line.me/api/notify';
$json = null;
$headers = [
    'Authorization: Bearer ' . $_SESSION['access_token']
];
$fields = [
    'message' => 'ทดสอบการส่งข้อความไปยังผู้ใช้งาน'
];

try {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $res = curl_exec($ch);
    curl_close($ch);

    if ($res == false)
        throw new Exception(curl_error($ch), curl_errno($ch));

    $json = json_decode($res);
    header("location: index.php");
} catch (Exception $e) {
    echo $e->getMessage();
}
