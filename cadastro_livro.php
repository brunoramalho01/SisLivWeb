<?php
$conn = new mysqli("localhost", "root", "", "livraria_db");
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $foto = $_POST["foto"];
    $autor = $_POST["autor"];
    $ano = $_POST["ano"];
    $editora_id = $_POST["editora"];
    $preco = $_POST["preco"];

    $stmt = $conn->prepare("INSERT INTO acervo (titulo, foto, autor, ano, editora_id, preco) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $titulo, $foto, $autor, $ano, $editora_id, $preco);
    $stmt->execute();
    $stmt->close();
    
    $mensagem = "Livro Salvo com Sucesso!";
        echo "<div style='padding: 20px; background-color: #04AA6D; color: white; margin-bottom: 15px;'>
        <span style='margin-left: 15px; color: white; font-weight: bold; float: left; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;' onclick='this.parentElement.style.display='none';'>"  
        . $mensagem . 
        "</span>
        <button><a href='ListarLivro.php'>Voltar ao Cadastro</a></button>
        </div>";
}
$conn->close();

?>
