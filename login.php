<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$mysqli = require __DIR__ . '/utils/database.php'; // connect to db
	$sql = sprintf(
		"SELECT * FROM user WHERE username = '%s'", //prepare sql query
		$mysqli->real_escape_string($_POST["username"]) //escape sql injection
	);
	$result = $mysqli->query($sql); // query made
	$user = $result->fetch_assoc(); // return as a associative array

	if ($user) {
		if (password_verify($_POST['password'], $user['password'])) {
			session_start();
			$_SESSION['user_id'] = $user['id'];
			header("Location: index.php");
			exit;
		}
	}
	$invalid = true;
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
	<form action="login.php" method="POST">
		<h2>Login</h2>
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password"><br>
		<?php
		if ($invalid) { ?>
			<p>Nome de usuário e/ou senha incorretos</p>
		<?php }
		?>
		<input type="submit" value="log in">
		<a href="signup.html">Registrar</a>

	</form>
</body>

</html>