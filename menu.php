<?php
	session_start();

	// Verifica se o usuário está logado
	if (!isset($_SESSION['usuario'])) {
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<style>
	body{
		background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
		color: white;
		text-align: center;
	}
	h1{
		margin-top: 30px;
		font-size: 36px;
		font-weight: bold;
	}
	.box{
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		padding: 0;
		list-style: none;
		margin-top: 50px;
	}
	.box li{
		margin: 20px;
		border-radius: 15px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		padding: 20px;
		background: rgba(0, 0, 0, 0.3);
		transition: all 0.3s ease-in-out;
	}
	.box li:hover{
		transform: translateY(-5px);
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
	}
	.box li a{
		color: white;
		text-decoration: none;
		font-size: 24px;
		font-weight: bold;
	}
	p{
		margin-top: 50px;
		font-size: 18px;
	}
	a{
		color: white;
		text-decoration: none;
	}
	a:hover{
		text-decoration: underline;
	}
	</style>
</head>
<body>
	<h1>Menu</h1>

  <ul class='box'>
	<li><a href="cadastro_produto.php">Cadastro de Produtos</a></li>
	<li><a href="listagem_produtos.php">Listagem de Produtos</a></li>
	<li><a href="cadastro_estabelecimento.php">Cadastro de Estabelecimentos</a></li>
	<li><a href="listagem_estabelecimentos.php">Listagem de Estabelecimentos</a></li>
	<li><a href="cadastrar_preco.php">Cadastrar Preços</a></li>
	<li><a href="listagem_preco.php">Listagem de Preços Mais Baratos</a></li>
</ul>

<p>Olá, <?php echo $_SESSION['usuario']; ?>. <a href="index.php">Sair</a></p>

</p>
</body>
</html>