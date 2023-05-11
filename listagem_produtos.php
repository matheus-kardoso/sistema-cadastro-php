<!DOCTYPE html>
<html>
  <head>
    <title>Listagem de Produtos</title>
  </head>
  <body>
    <h1>Listagem de Produtos</h1>

    <a href="menu.php" class="">Voltar</a>


    <table>
      <thead>
        <tr>
          <th>Nome do Produto</th>
          <th>Marca</th>
          <th>Tamanho/Quantidade</th>
        </tr>
      </thead>
      <tbody>


        <?php
          // Conexão com o banco de dados
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "faculdade";

          $conn = mysqli_connect($servername, $username, $password, $dbname);
          if (!$conn) {
            die("Conexão falhou: " . mysqli_connect_error());
          }

          // Selecionando todos os produtos
          $sql = "SELECT * FROM produtos";
          $result = mysqli_query($conn, $sql);

          // Exibindo cada produto na tabela
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>".$row["nome"]."</td><td>".$row["marca"]."</td><td>".$row["tamanho"]."</td></tr>";
            }
          } else {
            echo "<tr><td colspan='3'>Nenhum produto cadastrado.</td></tr>";
          }
        
          mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </body>
</html>

