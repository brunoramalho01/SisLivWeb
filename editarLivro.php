<?php
require_once('conectDB.php');

// Verificar se o ID do livro foi passado pela URL
if (isset($_GET['id'])) {
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

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $titulo = $_POST["titulo"];
    $foto = $_POST["foto"];
    $autor = $_POST["autor"];
    $ano = $_POST["ano"];
    $editora_id = $_POST["editora"];
    $preco = $_POST["preco"];

    // Atualizar os dados do livro no banco de dados
    $stmt = $conn->prepare("UPDATE acervo SET titulo=?, foto=?, autor=?, ano=?, editora_id=?, preco=? WHERE id=?");
    $stmt->bind_param("ssssisi", $titulo, $foto, $autor, $ano, $editora_id, $preco, $livro_id);
    $stmt->execute();
    $stmt->close();

    // Redirecionar para a página de listagem após a edição
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
    <title>Editar Livro</title>
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
        <h1>Editar Livro</h1>
        <form action="editarLivro.php?id=<?php echo $livro['id']; ?>" method="post">
        <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $livro['titulo']; ?>" required>

            <label for="foto">URL da Foto:</label>
            <input type="text" id="foto" name="foto" value="<?php echo $livro['foto']; ?>" required>
            <small><p>Use o exemplo "./img/nome_do_livro.jpg"</p></small>

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value="<?php echo $livro['autor']; ?>" required>

            <label for="ano">Ano:</label>
            <input type="text" id="ano" name="ano" value="<?php echo $livro['ano']; ?>" required>

            <label for="editora">Editora:</label>
            <select id="editora" name="editora" required>
                <?php
                $conn = new mysqli("localhost", "root", "", "livraria_db");

                if ($conn->connect_error) {
                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                }
        
                $query = "SELECT * FROM editora";
                $result = $conn->query($query);
                
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $livro['editora_id']) ? "selected" : "";
                    echo "<option value=\"{$row['id']}\" {$selected}>{$row['nome_editora']}</option>";
                }
                ?>
            </select>

            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" value="<?php echo $livro['preco']; ?>" required>

            <button type="submit">Salvar Edições</button>
        </form>
    </div>
</body>
</html>
