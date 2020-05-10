<?php
session_start();
if (!$_SESSION['login']) {
    header("Location:login.php");
    die();
}

if ($_POST['unlogin']) {
    session_destroy();
    header("Location login.php");
}

$connection = new PDO('mysql:host=localhost; dbname=forum; charset=utf8', 'root', 'root');
$data =$connection->query("SELECT * FROM comments WHERE moderations= '0' ORDER by date DESC ");

if ($_POST) {
    header("Location:admin.php");
}

?>

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

<h1>Администрация форума</h1>

<form method="post">
    <?foreach ($data as $comment) {?>
    <select name="<?=$comment['id']?>" id="<?=$comment['id']?>">
        <option value="ok">ОК</option> <br>
        <option value="no">Отклонить</option>
    </select>
    <label for="<?=$comment['id']?>">
        <?=$comment['user_name'] . ' оставилл коментарий ' . $comment['comment']. "<br/>"?>
    </label>
    <?}?>
    <input type="submit" value="Модерировать">
</form>

<hr>
<form method="post">
    <input type="submit"  name="unlogin" value="Выйти">
</form>

<?
echo "<pre>";
var_dump($_POST);
echo "</pre>";

foreach ($_POST as $num=>$checked) {
    if ($checked == 'ok') {
        $connection->query("UPDATE comments SET moderations = 'ok' WHERE id = '$num'");
    } else {
        $connection->query("UPDATE comments SET moderations = 'no' WHERE id = '$num'");
    }
}

