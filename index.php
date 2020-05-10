<?php

$connection = new PDO('mysql:host=localhost; dbname=forum;
charset=utf8', 'root', 'root');
$data =$connection->query("SELECT * FROM comments WHERE moderations='ok' ORDER by date DESC ");

if ($_POST['username']) {
    $userName = htmlspecialchars($_POST['username']);
    $comments = htmlspecialchars($_POST['comments']);
    $time = date("Y-m-d H:i:s");
    $connection->prepare("INSERT INTO comments (user_name, comment, date ) 
VALUES ('$userName', '$comments', '$time') ");
    header("Location: index.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    body {
        margin: 50px;
        font-family: Arial;
    }
    input, textarea, button {
        margin: 15px;
        display: block;
        font-size: 30px;
    }
</style>
        <h1>Форум любителей форумов</h1>
<form method="post">
    <input type="username" name="username" required placeholder="Ваше имя">
    <textarea type="comments" name="comments" required placeholder="Ваше сообщение" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="Отправить">
</form>
<hr>
<h2>Сообщения пользователей</h2>
<h3>Все сообщения проходят модерацию</h3>
<? if ($data) {
foreach ($data as $comments) {
?>

<div>
    <?echo $comments['date'] . ' ' . $comments['user_name'] . ' написал: '. $comments['comment']?>
</div>
<?}}?>
</body>
</html>
