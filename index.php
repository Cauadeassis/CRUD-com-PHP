<?php
session_start();
require_once "database.php";
$busca = $_GET["busca"] ?? "";
if ($busca != "") $GETquery = "SELECT * FROM produtos WHERE nome LIKE '%$busca%'";
else $GETquery = "SELECT * FROM produtos WHERE nome = 'nomeQueNaoExiste'";
$resultado = mysqli_query($databaseConnection, $GETquery);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <h1>Links</h1>
    <div class = "linksContainer">
    <a href="cadastroDeClientes.php">Cadastrar cliente</a>
    <a href="cadastroDeProdutos.php">Cadastrar produto</a>
    </div>
    <?php 
        if (isset($_SESSION["mensagem"])) {
            echo "<p>{$_SESSION["mensagem"]}</p>";
            unset($_SESSION["mensagem"]);
    }
    ?>
    <form method="GET">
        <input type="text" name="busca" placeholder="Buscar produto...">
        <button type="submit">Buscar</button>
    </form>
    <div class="grid-produtos">
        <?php
        while ($produto = mysqli_fetch_assoc($resultado)) {
            echo "<div class='produto'>";
                echo "<div class='img-container'><img src='" . $produto["imagem"] . "'></div>";
                echo "<h3>" . $produto["nome"] . "</h3>";
                echo "<p class='estoque'>" . $produto["estoque"] . " unidades</p>";
                echo "<p class='preco'>R$ " . number_format($produto["venda"], 2, ',', '.') . "</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>