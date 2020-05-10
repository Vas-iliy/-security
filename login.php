<?php
session_start();
$connection = new PDO('mysql:host=localhost; dbname=forum;
charset=utf8', 'root', 'root');
$data = $connection->query("SELECT * FROM login");
if ($_POST['login']) {
    foreach ($data as $info) {
        if ($_POST['login'] == $info['login'] and $_POST['password'] == $info['password']) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            header("Location: admin.php");
        }
    }

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

<h2>Вход в админку</h2>
<form method="post">
    <input type="login" name="login" required placeholder="Логин">
    <input type="password" name="password" required placeholder="Пароль">
    <input type="submit" value="Войти">
</form>