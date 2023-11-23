<?php
$conn = new mysqli("localhost", "root", "", "livraria_db");
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_editora = $_POST["nome_editora"];

    $stmt = $conn->prepare("INSERT INTO editora (nome_editora) VALUES (?)");
    $stmt->bind_param("s", $nome_editora);
    $stmt->execute();
    $stmt->close();

    $mensagem = "Editora Salva com Sucesso!";
        echo "<div style='padding: 20px; background-color: #04AA6D; color: white; margin-bottom: 15px;'>
        <span style='margin-left: 15px; color: white; font-weight: bold; float: left; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;' onclick='this.parentElement.style.display='none';'>"  
        . $mensagem . 
        "</span>
        <button><a href='cadastrarLivro.php'>Voltar ao Cadastro</a></button>
        </div>";

}
$conn->close();
?>
