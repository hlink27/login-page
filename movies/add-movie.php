<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require '../utils/database.php'; //connects to DB
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}"; //prepare a SQL string
    $result = $mysqli->query($sql); //query made
    $user = $result->fetch_assoc(); //organizes into an array

    if (isset($_GET['editing'])) {
        $edit = true;
        $sql = "SELECT * FROM movie WHERE id = {$_GET['id']};";
        $result = $mysqli->query($sql);
        $movie = $result->fetch_assoc();
    } else {
        $edit = false;
    }
} else {
    header("Location: login.php");
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/login-page/includes/head.html"; ?>
<title>Adicionar Filme</title>
</head>

<body class="main-container">
    <a href="../index.php" class="btn btn-outline-primary">Voltar</a>
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Adicionar Filme</h5>
            <form action="<?php echo ($edit == true) ? 'editmovie.php' : 'addmovie.php'; ?>" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Título</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="title" name="title" value="<?php echo ($edit === true) ? $movie['title'] : ''; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">URL Image</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="url" name="url" value="<?php echo ($edit === true) ? $movie['url'] : ''; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="synopsis"><?php echo ($edit === true) ? $movie['synopsis'] : ''; ?></textarea>
                        <label for="floatingTextarea">Sinopse</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="watched" <?php echo ($edit === true) ? (($movie['watched'] == 'on') ? 'checked' : '') : ''; ?>>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Já Assisti</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Nota</span>
                    <input type="number" min="0" max="10" step="0.1" class="form-control" id="notaInput" name="grade" value="<?php echo ($edit === true) ? floatval($movie['grade']) : ''; ?>">
                    <span class="input-group-text">/ 10</span>
                </div>

                <?php
                if (isset($edit)) { ?>
                    <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                <?php }
                ?>
                <input class="btn btn-primary" type="submit" value="Registrar">
            </form>
        </div>
    </div>
</body>

</html>