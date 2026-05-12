<?php 
session_start();
require_once "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $estoque = $_POST["estoque"];
    $custo = $_POST["custo"];
    $venda = $_POST["venda"];
    $pastaDeImagens = "images/";
    if (!file_exists($pastaDeImagens)) mkdir($pastaDeImagens, 0755, true);
    $nomeDaImagem = str_replace(" ", "_", $_FILES["imagem"]["name"]);
    $arquivoTemporario = $_FILES["imagem"]["tmp_name"];
    $URL = $pastaDeImagens . $nomeDaImagem;
    move_uploaded_file($arquivoTemporario, $URL);
    $POSTquery = 
        "INSERT INTO produtos (nome, estoque, custo, venda, imagem)
        VALUES ('$nome', '$estoque', '$custo', '$venda', '$URL')";
    mysqli_query($databaseConnection, $POSTquery);
    $_SESSION["mensagem"] = "Produto cadastrado com sucesso!";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre Produtos</title>
    <link rel="stylesheet" href="../styles/products.css">
</head>
<body>
    <form method = "POST" enctype="multipart/form-data">
        <label for="nome">Nome</label>
      <input 
        type="text" 
        id="nome" 
        name="nome" 
        placeholder="Digite o nome do produto..." 
        required
      >

      <label for="estoque">Estoque</label>
      <input 
        type="number" 
        id="estoque" 
        name="estoque" 
        placeholder="Digite a quantidade em estoque..." 
        required
      >

      <label for="custo">Custo</label>
      <input 
        type="number" 
        step="0.01"
        id="custo" 
        name="custo" 
        placeholder="Digite o custo..." 
        required
      >

      <label for="venda">Venda</label>
      <input 
        type="number" 
        step="0.01"
        id="venda" 
        name="venda" 
        placeholder="Digite o valor de venda..." 
        required
      >

      <label for="imagem">Imagem</label>
      <input 
        type="file" 
        id="imagem" 
        name="imagem" 
        accept="image/*"
        required
      >

      <button type="submit">Cadastrar Produto</button>

    </form>
</body>
</html>