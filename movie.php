<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/utils/database.php'; //connects to DB
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}"; //prepare a SQL string
    $result = $mysqli->query($sql); //query made
    $user = $result->fetch_assoc(); //organizes into an array

    $sql = "SELECT * FROM movie WHERE id = {$_GET['id']};";
    $result = $mysqli->query($sql);
    $movie = $result->fetch_assoc();
} else {
    header("Location: login.php");
}
?>
<?php include('includes/head.html'); ?>
<title><?php echo $movie['title'] ?></title>
</head>

<body>
    <?php include(__DIR__ . '/includes/navbar.php') ?>
    <main class="movie-container">
        <div class="movie-poster-open">
            <img src="<?= $movie['url'] ?>">
        </div>
        <div class="movie-info">
            <h2><?php echo $movie['title'] ?></h2>
            <div class="movie-text">
                <p><?php echo $movie['synopsis'] ?></p>
                <?php
                if (isset($movie['watched'])) { ?>
                    <span class="badge text-bg-success">Assistido</span>
                    <span class="badge text-bg-secondary"><?php echo $movie['grade'] ?>/10</span>
                <?php } else { ?>
                    <span class="badge text-bg-danger">Não Assistido</span>
                <?php }
                ?>
            </div>
            <a href="movies/add-movie.php?id=<?= $movie['id'] ?>&editing=true" class="btn btn-primary">Editar</a>
            <a href="movies/delete.php?id=<?= $movie['id'] ?>" class="btn btn-danger">Deletar</a>
        </div>
    </main>
</body>