<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//capture values
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

//revalidate inputs if somehow utils/validation.js fails
if (empty($username)) {
    die('invalid username');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('invalid email');
}
if (strlen($password) < 5) {
    die('password needs to be longer than 5 chars');
}
if ($password != $password2) {
    die('passwords must match');
}

//hash password
$password_hashed = password_hash($password, PASSWORD_BCRYPT);

//insert new user in database
$mysqli = require __DIR__ . '/utils/database.php';
$sql = "INSERT INTO user (username, email, password, createdAt, editedAt, deletedAt)
        VALUES (?, ?, ?, ?, ?, NULL)";
$stmt = $mysqli->stmt_init(); //maybe boilerplate dunno
if (!$stmt->prepare($sql)) {
    die('SQL error');
}
$currentTime = date('Y-m-d H:i:s'); //get time
$stmt->bind_param(
    "sssss",
    $username,
    $email,
    $password_hashed,
    $currentTime,
    $currentTime
);
if ($stmt->execute()) {
    header("Location: signup-success.html");
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
