<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/utils/database.php'; //connects to DB
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}"; //prepare a SQL string
    $result = $mysqli->query($sql); //query made
    $user = $result->fetch_assoc(); //organizes into an array
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Home</h2>
    <?php
    if (isset($user)) { ?>
        <p>Bem vindo, <?= $user['username'] ?></p>
        <a href="logout.php">Sair</a>
    <?php } else { ?>
        <a href="login.php">Logar</a>
    <?php } ?>
</body>

</html>