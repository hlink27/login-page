<?php

$mysqli = require '../utils/database.php';
$sql = "SELECT * FROM movie WHERE watched IS NULL;";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    $movies = array();
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row['id'];
    }
} else {
    $movies = array();
}

$rand_key = array_rand($movies);
header("Location: ../movie.php?id=" . urlencode($movies[$rand_key]));
