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
			session_regenerate_id(); //prevents session fixation attck
			$_SESSION['user_id'] = $user['id'];
			header("Location: index.php");
			exit;
		}
	}
	$invalid = true;
}
?>
<?php include('includes/head.html'); ?>
<title>Log in</title>
</head>

<body class="main-container">
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Log In</h5>
			<form action="login.php" method="POST">
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
					<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="inputGroup-sizing-default">Senha</span>
					<input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="password" name="password">
				</div>
				<?php
				if ($invalid) { ?>
					<p>Nome de usuário e/ou senha incorretos</p>
				<?php }
				?>
				<input class="btn btn-primary" type="submit" value="Log in">
			</form>
			<a href="signup.html" class="card-link">Registrar</a>
		</div>
	</div>
</body>

</html>