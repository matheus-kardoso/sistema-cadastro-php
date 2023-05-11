<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Preços de Produtos em Estabelecimentos</title>
</head>
<body>

	<h1>Cadastro de Preços de Produtos em Estabelecimentos</h1>

	<a href="menu.php" class="">Voltar</a>


	<?php
		// Conexão com o banco de dados
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "faculdade";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		// Consulta para preencher os selects com os dados dos produtos e estabelecimentos cadastrados
		$sql_produtos = "SELECT id, nome FROM produtos";
		$result_produtos = mysqli_query($conn, $sql_produtos);

		$sql_estabelecimentos = "SELECT id_estabelecimento, nome_fantasia FROM estabelecimentos";
		$result_estabelecimentos = mysqli_query($conn, $sql_estabelecimentos);

		// Verifica se o formulário foi enviado
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// Define as variáveis com os valores enviados pelo formulário
			$id_produto = $_POST["produto"];
			$id_estabelecimento = $_POST["estabelecimento"];
			$preco = $_POST["preco"];

			// Insere o registro na tabela de preços
			$sql_preco = "INSERT INTO precos (id_produto, id_estabelecimento, preco) VALUES ('$id_produto', '$id_estabelecimento', '$preco')";

			if (mysqli_query($conn, $sql_preco)) {
				echo "<p>Preço cadastrado com sucesso!</p>";
			} else {
				echo "Erro ao cadastrar preço: " . mysqli_error($conn);
			}
		}

		// Fecha a conexão com o banco de dados
		mysqli_close($conn);
	?>

	<!-- Formulário de cadastro de preços -->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="produto">Produto:</label>
		<select name="produto" id="produto">
			<?php while ($row = mysqli_fetch_assoc($result_produtos)) { ?>
				<option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
			<?php } ?>
		</select>
		<br><br>
		<label for="estabelecimento">Estabelecimento:</label>
		<select name="estabelecimento" id="estabelecimento">
			<?php while ($row = mysqli_fetch_assoc($result_estabelecimentos)) { ?>
				<option value="<?php echo $row['id_estabelecimento']; ?>"><?php echo $row['nome_fantasia']; ?></option>
			<?php } ?>
		</select>
		<br><br>
		<label for="preco">Preço:</label>
		<input type="text" name="preco" id="preco">
		<br><br>
		<input type="submit" value="Cadastrar">
	
