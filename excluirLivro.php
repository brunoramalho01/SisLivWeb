<?php
require_once('conectDB.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $livro_id = $_GET['id'];

    // Consultar os dados do livro pelo ID
    $query = "SELECT * FROM acervo WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $livro_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $livro = $result->fetch_assoc();
    } else {
        echo "Livro não encontrado.";
        exit();
    }

    $stmt->close();
} else {
    echo "ID do livro não especificado.";
    exit();
}

// Verificar se o formulário de confirmação foi enviado
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Excluir o livro do banco de dados
    $query = "DELETE FROM acervo WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $livro_id);
    $stmt->execute();
    $stmt->close();

    // Redirecionar para a página de listagem após a exclusão
    header("Location: listarLivro.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Excluir Livro</title>
</head>
<body>
    <!-- Menu de Navegacao-->
    <div class="menu">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="cadastrarLivro.php">Cadastrar</a></li>
            <li><a href="editar_livro.php">Editar</a></li>
            <li><a href="excluir_livro.php">Excluir</a></li>
            <li><a href="listarLivros.php">Listar</a></li>
        </ul>
    </div>

    <div class="container">
        <h1>Excluir Livro</h1>
        <p>Você está prestes a excluir o livro: <?php echo $livro['titulo']; ?></p>
        <p>Tem certeza que deseja excluir este livro?</p>
        <form action="excluirLivro.php?id=<?php echo $livro['id']; ?>" method="post">
            <button type="submit" name="id">Confirmar Exclusão</button>
            <a href="listarLivro.php"><button class="btn-excluir">Cancelar</button></a>
        </form>
    </div>
</body>
</html>
