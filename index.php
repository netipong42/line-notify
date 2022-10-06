<?php
session_start();

$client_id = 'j5Hgzh1vbRqZm2RIsjdMDn';
$client_secret = '1NrChDJ7sQK2zvDAeH0DEFiQfiZDgk6QS2PkAaaoehI';
$callback_url = 'http://localhost/line-notify/callback.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <a class="btn btn-success mt-5" href="<?php echo "https://notify-bot.line.me/oauth/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . $callback_url . "&scope=notify&state=" . $client_secret . "" ?>">
            รับการแจ้งเตือนผ่าน LINE Notify
        </a>

        <?php if ($_SESSION['access_token'] != '') {  ?>
            <a class="btn btn-primary mt-5" href="./sendmessage.php">
                ทดสอบ LINE Notify
            </a>
        <?php }  ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>