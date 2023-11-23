<?php

require_once ('conectDB.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Portfolio Livraria</title>
</head>
<body>
        <!-- Menu de Navegacao-->
        <div class="menu">
        <ul>
            <li><a href="index.html" class="active">Home</a></li>
            <li><a href="cadastrarLivro.php">Cadastrar</a></li>
            <li><a href="editar_livro.php">Editar</a></li>
            <li><a href="#">Excluir</a></li>
            <li><a href="listarLivro.php">Listar</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>Cadastro de Editora</h1>
        <form action="cadastro_editora.php" method="post">
            <label for="nome_editora">Nome da Editora:</label>
            <input type="text" id="nome_editora" name="nome_editora" required>
            <button type="submit">Cadastrar Editora</button>
            <p><?php echo @$mensagem ?></p>
        </form>

        <h1>Cadastro de Livro</h1>
        <form action="cadastro_livro.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="foto">URL da Foto:</label>
            <input type="text" id="foto" name="foto" required>
            <small><p>use o exemplo "./img/nome_do_livro.jpg"</p></small>

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>

            <label for="ano">Ano:</label>
            <input type="text" id="ano" name="ano" required>

            <label for="editora">Editora:</label>
            <select id="editora" name="editora" required>
                <?php
                    
                    // Consultar as editoras
                    $result = $conn->query("SELECT id, nome_editora FROM editora");
                    // Exibir as opções do select
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"{$row['id']}\">{$row['nome_editora']}</option>";
                    }
                    // Fechar a conexão
                    $conn->close();
                ?>
            </select>

            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>

            <button type="submit">Cadastrar Livro</button>

            
        </form>
    </div>
</body>
</html>
