<?php
include_once '../includes/dbconnect.php';

$erro = '';
$success = '';

//Inserir/Atualizar Serviço
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nome_serv"], $_POST["preco_serv"], $_POST["prazo_serv"])) {
        if (empty($_POST["nome_serv"]) || empty($_POST["preco_serv"]) || empty($_POST["prazo_serv"])) {
            $erro = "Todos os campos são obrigatórios.";
        } else {
            $id_serv = isset($_POST["id_serv"]) ? $_POST["id_serv"] : -1;
            $nome_serv = $_POST["nome_serv"];
            $descricao_serv = $_POST["descricao_serv"];
            $preco_serv = $_POST["preco_serv"];
            $prazo_serv = $_POST["prazo_serv"];

            //Formatando prazo_serv para DATETIME
            $prazo_serv = date('Y-m-d H:i:s', strtotime("+$prazo_serv days"));

            if ($id_serv == -1) { // Inserir novo serviço
                $stmt = $mysqli->prepare("INSERT INTO Servico (nome_serv, desc_serv, preco_serv, prazo_serv, status_serv) VALUES (?, ?, ?, ?, 'ativo')");
                $stmt->bind_param("ssds", $nome_serv, $descricao_serv, $preco_serv, $prazo_serv);

                if ($stmt->execute()) {
                    $success = "Serviço cadastrado com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar serviço: " . $stmt->error;
                }
            } else { //Atualizar serviço existente
                $stmt = $mysqli->prepare("UPDATE Servico SET nome_serv = ?, desc_serv = ?, preco_serv = ?, prazo_serv = ? WHERE id_serv = ?");
                $stmt->bind_param("ssdsi", $nome_serv, $descricao_serv, $preco_serv, $prazo_serv, $id_serv);

                if ($stmt->execute()) {
                    $success = "Serviço atualizado com sucesso.";
                } else {
                    $erro = "Erro ao atualizar serviço: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

//Desabilitar Serviço
if (isset($_GET["id_serv"]) && is_numeric($_GET["id_serv"]) && isset($_GET["del"])) {
    $id_serv = (int) $_GET["id_serv"];
    $stmt = $mysqli->prepare("UPDATE Servico SET status_serv = 'desabilitado' WHERE id_serv = ?"); //Atualizando para 'desabilitado'
    $stmt->bind_param('i', $id_serv);
    if ($stmt->execute()) {
        $success = "Serviço desabilitado com sucesso.";
    } else {
        $erro = "Erro ao desabilitar serviço: " . $stmt->error;
    }
}

//Listar Serviços
$result = $mysqli->query("SELECT * FROM Servico WHERE status_serv = 'ativo'"); // Somente serviços ativos
?>

<?php include_once '../../HTML/headerCRUD.php' ?>

<body>
    <h1>Cadastro de Serviços</h1>

    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar serviço -->
    <form action="servico.php" method="POST">
        <input type="hidden" name="id_serv" value="<?= isset($_POST['id_serv']) ? $_POST['id_serv'] : -1 ?>">

        <label for="nome_serv">Nome do Serviço:</label><br>
        <input type="text" name="nome_serv"
            value="<?= isset($_POST['nome_serv']) ? htmlspecialchars($_POST['nome_serv']) : '' ?>" required><br><br>

        <label for="descricao_serv">Descrição:</label><br>
        <input type="text" name="descricao_serv"
            value="<?= isset($_POST['descricao_serv']) ? htmlspecialchars($_POST['descricao_serv']) : '' ?>"><br><br>

        <label for="preco_serv">Preço do Serviço:</label><br>
        <input type="text" id="preco_serv" name="preco_serv" placeholder="R$ 0,00"
            value="<?= isset($_POST['preco_serv']) ? htmlspecialchars($_POST['preco_serv']) : '' ?>"
            required><br><br>

        <script>
            document.getElementById('preco_serv').addEventListener('input', function (e) {
                // Remove qualquer caractere não numérico
                let value = e.target.value.replace(/[^0-9]/g, '');

                // Se o valor estiver vazio, não faz nada
                if (value === '') {
                    e.target.value = '';
                    return;
                }

                // Define a parte decimal (centavos)
                let decimalPart = value.slice(-2).padStart(2, '0');
                // Define a parte inteira (reais)
                let integerPart = value.slice(0, -2);

                // Remove zeros à esquerda da parte inteira
                integerPart = integerPart.replace(/^0+/, '') || '0'; // Se estiver vazio, torna-se '0'

                // Adiciona separador de milhar
                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Formata o valor final
                let formattedValue = integerPart + ',' + decimalPart;

                // Define o valor formatado no campo
                e.target.value = 'R$ ' + formattedValue;
            });
        </script>

        <label for="prazo_serv">Prazo (dias):</label><br>
        <input type="number" name="prazo_serv" min="1"
            value="<?= isset($_POST['prazo_serv']) ? htmlspecialchars($_POST['prazo_serv']) : '' ?>" required><br><br>

        <button
            type="submit"><?= (isset($_POST['id_serv']) && $_POST['id_serv'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição dos serviços -->
    <h2>Lista de Serviços</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Prazo (dias)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($servico = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($servico['id_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['nome_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['desc_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['preco_serv']) ?></td>
                    <td><?= htmlspecialchars($servico['prazo_serv']) ?></td>
                    <td>
                        <a href="servico.php?id_serv=<?= $servico['id_serv'] ?>&del=1"
                            onclick="return confirm('Tem certeza que deseja desabilitar este serviço?')">Desabilitar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>