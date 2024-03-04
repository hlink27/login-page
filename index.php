<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $mysqli = require __DIR__ . '/utils/database.php'; //connects to DB
    $sql = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}"; //prepare a SQL string
    $result = $mysqli->query($sql); //query made
    $user = $result->fetch_assoc(); //organizes into an array

    $sql = "SELECT * FROM movie;";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $movies = array();
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    } else {
        $movies = array();
    }
} else {
    header("Location: login.php");
}

?>
<?php include('includes/head.html'); ?>
<title>Home</title>
</head>

<body>
    <?php include(__DIR__ . '/includes/navbar.php') ?>
    <main class="main-container">
        <?php
        if (sizeof($movies) > 0) {
            foreach ($movies as $movie) { ?>
                <a href="movie.php?id=<?php echo $movie['id']; ?>">
                    <div class="movie-poster" title="<?= $movie['title'] ?>">
                        <img src="<?= $movie['url'] ?>" alt="<?= $movie['title'] ?>">
                    </div>
                </a>
        <?php }
        } ?>
    </main>
</body>

</html>