<?php
session_start();

$client_id = 'j5Hgzh1vbRqZm2RIsjdMDn';
$client_secret = '1NrChDJ7sQK2zvDAeH0DEFiQfiZDgk6QS2PkAaaoehI';
$callback_url = 'http://localhost/line-notify/callback.php';
$api_url = 'https://notify-bot.line.me/oauth/token';

parse_str($_SERVER['QUERY_STRING'], $queries);

// var_dump($queries);
$fields = [
    'grant_type' => 'authorization_code',
    'code' => $queries['code'],
    'redirect_uri' => $callback_url,
    'client_id' => $client_id,
    'client_secret' => $client_secret
];

try {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $res = curl_exec($ch);
    curl_close($ch);

    if ($res == false)
        throw new Exception(curl_error($ch), curl_errno($ch));

    $json = json_decode($res, true);

    if ($json['access_token'] != '') {
        $_SESSION['access_token'] = $json['access_token'];
    }
    echo $_SESSION['access_token'];
    header("location: index.php");
} catch (Exception $e) {
    echo $e->getMessage();
}
