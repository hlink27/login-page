<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/utils/database.php'; //connects to DB
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}"; //prepare a SQL string
    $result = $mysqli->query($sql); //query made
    $user = $result->fetch_assoc(); //organizes into an array
} else {
    header("Location: login.php");
}

?>
<?php include('includes/head.html'); ?>
<title>Home</title>
</head>

<body class="main-container">
    <?php
    if (isset($user)) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h3 class="card-title">Home</h3>
                <h6>Bem vindo, <?= htmlspecialchars($user['username']);  ?></h6>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    <?php } ?>
</body>

</html>