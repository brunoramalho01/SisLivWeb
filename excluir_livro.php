<?php
require_once('conectDB.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_POST['id'])) {
    $livro_id = $_POST['id'];

    // Redirecionar para a página de edição com o ID do livro escolhido
    header("Location: excluirLivro.php?id=$livro_id");
    exit();
}

// Consultar os livros
$livros_result = $conn->query("SELECT id, titulo FROM acervo");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Selecionar Livro para Excluir</title>
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

    <div class="container">
        <h1>Selecionar Livro para Excluir</h1>
        <form action="excluirLivro.php" method="get">
            <label for="id">Escolha o Livro:</label>
            <select id="id" name="id" required>
                <?php
                // Exibir as opções do select
                while ($livro_row = $livros_result->fetch_assoc()) {
                    echo "<option value=\"{$livro_row['id']}\">{$livro_row['titulo']}</option>";
                }
                ?>
            </select>
            <button type="submit">Excluir Livro</button>
        </form>
    </div>
</body>
</html>