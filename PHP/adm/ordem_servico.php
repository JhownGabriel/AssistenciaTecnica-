<?php

include_once '../includes/dbconnect.php';

$erro = '';
$success = '';

// Inserir/Atualizar Ordem de Serviço
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["data_ordem_servico"]) && !empty($_POST["id_cli"]) && isset($_SESSION['id'])) {
        $id_ordem = isset($_POST["id_ordem"]) ? $_POST["id_ordem"] : -1;
        $data_ordem_servico = $_POST["data_ordem_servico"];
        $id_cli = $_POST["id_cli"];
        $id_usu = $_SESSION["id"];  // Usar o ID da sessão do usuário

        // Inserção
        if ($id_ordem == -1) {
            $stmt = $mysqli->prepare("INSERT INTO Ordem_servico (data_ordem_servico, id_cli, id_usu) VALUES (?, ?, ?)");
            if ($stmt === false) {
                $erro = "Erro ao preparar a consulta: " . $mysqli->error;
            } else {
                $stmt->bind_param("sii", $data_ordem_servico, $id_cli, $id_usu);
                if ($stmt->execute()) {
                    $success = "Ordem de serviço cadastrada com sucesso.";
                } else {
                    $erro = "Erro ao cadastrar ordem de serviço: " . $stmt->error;
                }
            }
        } else {
            // Atualização
            $stmt = $mysqli->prepare("UPDATE Ordem_servico SET data_ordem_servico = ?, id_cli = ?, id_usu = ? WHERE id_ordem = ?");
            if ($stmt === false) {
                $erro = "Erro ao preparar a consulta: " . $mysqli->error;
            } else {
                $stmt->bind_param("siii", $data_ordem_servico, $id_cli, $id_usu, $id_ordem);
                if ($stmt->execute()) {
                    $success = "Ordem de serviço atualizada com sucesso.";
                } else {
                    $erro = "Erro ao atualizar ordem de serviço: " . $stmt->error;
                }
            }
        }
    } else {
        $erro = "Todos os campos são obrigatórios.";
    }
}

// Listar Ordens de Serviço
$result = $mysqli->query("SELECT os.*, c.nome_cli, u.nome_usu FROM Ordem_servico os LEFT JOIN Cliente c ON os.id_cli = c.id_cli LEFT JOIN Usuario u ON os.id_usu = u.id_usu");
?>

<?php require_once 'headerCRUD.php'; ?>
<link rel="stylesheet" href="styleCRUD/stylecrud.css" type="text/css">
<body>
    <h1>Cadastro de Ordens de Serviço</h1>

    <!-- Exibindo mensagens de erro ou sucesso -->
    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <!-- Formulário para adicionar ou editar ordem de serviço -->
    <form action="ordem_servico.php" method="POST">
        <input type="hidden" name="id_ordem" value="<?= isset($_POST['id_ordem']) ? $_POST['id_ordem'] : -1 ?>">

        <input type="hidden" name="data_ordem_servico" value="<?= date('Y-m-d H:i:s') ?>" required>

        <label for="id_cli">Cliente:</label><br>
        <select name="id_cli" required>
            <option value="">Selecione um cliente</option>
            <?php
            $clientes = $mysqli->query("SELECT id_cli, nome_cli FROM Cliente");
            while ($cliente = $clientes->fetch_assoc()) {
                $selected = (isset($_POST['id_cli']) && $_POST['id_cli'] == $cliente['id_cli']) ? 'selected' : '';
                echo "<option value='{$cliente['id_cli']}' $selected>{$cliente['nome_cli']}</option>";
            }
            ?>
        </select><br><br>

        <label for="id_usu">Usuário:</label><br>
            <input name="id_usu" value="<?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : ''; ?>" disabled><br><br>

        <button
            type="submit"><?= (isset($_POST['id_ordem']) && $_POST['id_ordem'] != -1) ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <hr>

    <!-- Exibição das ordens de serviço -->
    <h2>Lista de Ordens de Serviço</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Usuário</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($ordem_servico = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($ordem_servico['id_ordem']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['data_ordem_servico']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['nome_cli']) ?></td>
                    <td><?= htmlspecialchars($ordem_servico['nome_usu']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</html>