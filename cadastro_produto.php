<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produto</title>
</head>
<body>
    <h1>Cadastro de Produto</h1>

    <a href="menu.php" class="">Voltar</a>
    
    <?php
        // Verifica se o formulário foi enviado
        if (isset($_POST['submit'])) {
            // Recupera os dados do formulário
            $nome = $_POST['nome'];
            $marca = $_POST['marca'];
            $tamanho = $_POST['tamanho'];

            // Aqui deve ser feita a inserção dos dados no banco de dados
            // Substitua os valores entre aspas pelas suas informações de conexão
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "faculdade";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO produtos (nome, marca, tamanho) VALUES ('$nome', '$marca', '$tamanho')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Produto cadastrado com sucesso</p>";
            } else {
                echo "<p>Erro ao cadastrar produto: " . mysqli_error($conn) . "</p>";
            }
            header("Location: menu.php");
            mysqli_close($conn);
        }
    ?>
   

    <form method="post">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome">
        <br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca">
        <br>

        <label for="tamanho">Tamanho/Quantidade:</label>
        <input type="text" id="tamanho" name="tamanho">
        <br>

        <input type="submit" name="submit" value="Cadastrar">
    </form>
</body>
</html>
