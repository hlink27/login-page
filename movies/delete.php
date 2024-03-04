<?php
$id = $_GET['id'];

$mysqli = require '../utils/database.php';
$sql = "DELETE FROM movie WHERE id = {$id}";
$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die('SQL error');
}
if ($stmt->execute()) {
    header("Location: ../index.php");
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
