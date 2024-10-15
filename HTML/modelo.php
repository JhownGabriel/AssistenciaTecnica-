<?php
include_once '../PHP/includes/dbconnect.php';

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Prepara a consulta para buscar os detalhes do produto
    $stmt = $mysqli->prepare("SELECT * FROM Produtos WHERE id_prod = ?");
    $stmt->bind_param('i', $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o produto existe
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc(); // Pega os detalhes do produto
    } else {
        echo "<p>Produto não encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID do produto não foi informado.</p>";
    exit;
}

?>
<?php
    require_once 'header.php';
?>
    <main>
        <div class="modelos1">
            <div id="fotos"></div>
                <h1 id="titulomdl"><?= htmlspecialchars($produto['nome_prod']) ?></h1>
                <p id="modeloinfo"><?= htmlspecialchars($produto['desc_prod']) ?></p>
            <form id="vazio" action="obrigado.html">
        <button id="confirma" type="submit"><p>Entrar em Contato</p><i id="zap" class="fa-brands fa-square-whatsapp"></i></button>   
        </div>
    </main>
    <?php
        require_once 'footer.php';
    ?>