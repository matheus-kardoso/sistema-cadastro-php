<?php
	session_start();

	// Verifica se o usuário já está logado
	if (isset($_SESSION['usuario'])) {
		header("Location: menu.php");
		exit();
	}

	// Verifica se o usuário enviou o formulário de login
	if (isset($_POST['submit'])) {
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];

		// Aqui deve ser feita a verificação do usuário e senha no banco de dados
		// Substitua os valores entre aspas pelas suas informações de conexão
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "faculdade";

		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			$_SESSION['usuario'] = $usuario;
			header("Location: menu.php");
			exit();
		} else {
			$erro = "Usuário ou senha inválidos";
		}

		mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Página de Login</title>
</head>
<body>
	<h1>Página de Login</h1>

	<?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>

	<form method="post">
		<label for="usuario">Usuário:</label>
		<input type="text" id="usuario" name="usuario">
		<br>

		<label for="senha">Senha:</label>
		<input type="password" id="senha" name="senha">
		<br>

		<input type="submit" name="submit" value="Entrar">
	</form>
</body>
</html>
