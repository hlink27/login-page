<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//capture values
session_start();
$title = $_POST['title'];
$url = $_POST['url'];
$synopsis = $_POST['synopsis'];
$userid = $_SESSION['user_id'];

function is_float_string($str)
{
    $float_val = floatval($str);
    if ($str !== '' && $str == $float_val && is_float($float_val)) {
        return true;
    } else {
        return false;
    }
}

//Check if grade is really a number
if (is_float_string($_POST['grade']) || $_POST['grade'] === null) {
    $grade = $_POST['grade'];
} else {
    $grade = null;
}

//Check if watched is really on or null
if ($_POST['watched'] === 'on' || $_POST['watched'] === null) {
    $watched = $_POST['watched'];
} else {
    $watched = null;
}

//insert new user in database
$mysqli = require '../utils/database.php';
$sql = "INSERT INTO movie (title, url, synopsis, watched, grade, userid)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init(); //maybe boilerplate dunno
if (!$stmt->prepare($sql)) {
    die('SQL error');
}
$stmt->bind_param(
    "sssssi",
    $title,
    $url,
    $synopsis,
    $watched,
    $grade,
    $userid
);
if ($stmt->execute()) {
    header("Location: ../index.php");
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
