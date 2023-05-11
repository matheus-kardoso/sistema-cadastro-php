<a href="menu.php" class="">Voltar</a>


<?php
// Estabelecimento selecionado pelo usuário
$estabelecimento_id = isset($_POST['estabelecimento_id']) ? $_POST['estabelecimento_id'] : '';

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'faculdade');

// Verifica se ocorreu algum erro de conexão
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Busca todos os produtos cadastrados
$query = "SELECT * FROM produtos";
$result = mysqli_query($conn, $query);

// Array para armazenar o menor preço de cada produto
$menor_preco = array();

// Inicializa o array com preços muito altos
while ($row = mysqli_fetch_assoc($result)) {
    $menor_preco[$row['id']] = PHP_FLOAT_MAX;
}

// Busca o menor preço de cada produto entre todos os estabelecimentos
$query = "SELECT id_produto, id_estabelecimento, preco FROM precos";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['preco'] < $menor_preco[$row['id_produto']]) {
        $menor_preco[$row['id_produto']] = $row['preco'];
    }
}

// Busca os dados do estabelecimento selecionado
$query = "SELECT * FROM estabelecimentos WHERE id_estabelecimento = '$estabelecimento_id'";
$result = mysqli_query($conn, $query);
$estabelecimento = mysqli_fetch_assoc($result);

// Busca os preços dos produtos no estabelecimento selecionado
$query = "SELECT produtos.*, precos.preco FROM produtos 
          INNER JOIN precos ON produtos.id = precos.idprecos
          WHERE precos.idprecos = '$estabelecimento_id'";

$result = mysqli_query($conn, $query);

// Exibe a lista de produtos
echo "<h1>Produtos mais baratos em " . $estabelecimento['nome_fantasia'] . "</h1>";


echo "<table border='1'>";
echo "<tr><th>Produto</th><th>Marca</th><th>Tamanho/Quantidade</th><th>Preço</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['preco'] == $menor_preco[$row['id']]) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['tamanho'] . "</td>";
        echo "<td>" . number_format($row['preco'], 2, ',', '.') . "</td>";
        echo "</tr>";
    }
}

echo "</table>";

// Fecha a conexão com o banco de dados
$conn->close();
?>
