<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Estabelecimento</title>
</head>
<body>
    <h1>Cadastro de Estabelecimento</h1>

    <a href="menu.php" class="">Voltar</a>

    <?php
        // Verifica se o formulário foi enviado
        if (isset($_POST['submit'])) {
            // Recupera os dados do formulário
            $nome_fantasia = $_POST['nome_fantasia'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $num_lojas = $_POST['num_lojas'];

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

            $sql = "INSERT INTO estabelecimentos (nome_fantasia, endereco, cidade, num_lojas) VALUES ('$nome_fantasia', '$endereco', '$cidade', '$num_lojas')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Estabelecimento cadastrado com sucesso</p>";
            } else {
                echo "<p>Erro ao cadastrar estabelecimento: " . mysqli_error($conn) . "</p>";
            }

            mysqli_close($conn);
        }
    ?>

    <form method="post">
        <label for="nome_fantasia">Nome Fantasia:</label>
        <input type="text" id="nome_fantasia" name="nome_fantasia">
        <br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco">
        <br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">
        <br>

        <label for="num_lojas">Número de Lojas:</label>
        <input type="text" id="num_lojas" name="num_lojas">
        <br>

        <input type="submit" name="submit" value="Cadastrar">
    </form>
</body>
</html>
