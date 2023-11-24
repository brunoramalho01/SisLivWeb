<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Livraria</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/card.css">
</head>
<body>
    <!-- Menu de Navegacao-->
    <div class="menu">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="cadastrarLivro.php">Cadastrar</a></li>
            <li><a href="editar_livro.php">Editar</a></li>
            <li><a href="excluir_livro.php">Excluir</a></li>
            <li><a href="listarLivro.php">Listar</a></li>
        </ul>
    </div>
    <div class="livros">
    <?php
        $conn = new mysqli("localhost", "root", "", "livraria_db");

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        $query = "SELECT acervo.*, editora.nome_editora 
                FROM acervo 
                INNER JOIN editora ON acervo.editora_id = editora.id";

        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<div class='flip-card'>";
            echo "<div class='flip-card-inner'>";
            echo "<div class='flip-card-front'>";
            echo "<img src='{$row['foto']}' alt='{$row['titulo']}' style='width:200px;height:300px;'>";
            echo "</div>";
            echo "<div class='flip-card-back'>";
            echo "<h3>{$row['titulo']}</h3>";
            echo "<p>{$row['nome_editora']}</p>";
            echo "<p>{$row['ano']}</p>";
            echo "<p>Preço(R$): {$row['preco']}</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $conn->close();
    ?>

    </div>
</body>
</html>