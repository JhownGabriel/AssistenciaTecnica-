<?php
include_once '../PHP/auth.php';
// Incluindo o arquivo de conexão com o banco de dados
include_once '../PHP/includes/dbconnect.php';

// Verificando se a conexão foi criada corretamente
if (!isset($mysqli)) {
    die("Erro: A conexão com o banco de dados não foi estabelecida.");
}

// Verificando se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletando os dados do formulário
    $nome = $_POST['nome'];
    $nome_social = $_POST['nomesocial'] ?? null;
    $email = $_POST['email'];
    $telefone = $_POST['telefone'] ?? null;
    $celular = $_POST['celular'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;
    $tipo_documento = $_POST['tipo_documento'];
    $documento = $_POST['documento'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $senha = $_POST['password']; // Criptografando a senha
    $data_cadastro = date('Y-m-d H:i:s'); // Pegando a data e hora atual
    $status = 'ativo'; // Definindo o status do usuário como ativo

    // Criando a query de inserção
    $sql = "INSERT INTO Usuario (data_cadastro_usu, nome_usu, nome_social, email_usu, telefone_usu, celular_usu, data_nascimento, tipo_do_documento_usu, documento_usu, uf, cidade, bairro, rua, numero, complemento, cep, status_usu, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparando a declaração para evitar SQL Injection
    $stmt = $mysqli->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $mysqli->error);
    }

    // Vinculando os parâmetros da query aos valores recebidos do formulário
    $stmt->bind_param("ssssssssssssssssss", $data_cadastro, $nome, $nome_social, $email, $telefone, $celular, $data_nascimento, $tipo_documento, $documento, $uf, $cidade, $bairro, $rua, $numero, $complemento, $cep, $status, $senha);

    // Executando a query
    if ($stmt->execute()) {
        // Redirecionando para uma página de sucesso ou exibindo uma mensagem de sucesso
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='index.php';</script>";
    } else {
        // Exibindo uma mensagem de erro
        echo "<script>alert('Erro ao cadastrar o usuário: " . $stmt->error . "');</script>";
    }

    // Fechando a declaração
    $stmt->close();
}

// Fechando a conexão com o banco de dados
if (isset($mysqli)) {
    $mysqli->close();
}
?>
<?php
    require_once 'header.php';
?>
    <main>
        <div>
            <form action="" method="post" id="form_cadastro">
                <div id="logo"><img src="../images/logoazul.png" alt="logo"></div>
                <h1>Cadastro</h1>
                <hr>
                <label for="nome">Nome</label><br>
                <input type="text" id="nome" name="nome"><br>

                <label for="email">email</label><br>
                <input type="email" name="email" id="email" required><br>

                <label for="">telefone</label><br>
                <input type="text" id="telefone" name="telefone" placeholder="(00) 1234-5678"><br>

                <label for="celular">Celular</label><br>
                <input type="text" name="celular" id="celular"><br>

                <label for="data_nascimento">Data de nascimento</label><br>
                <input type="date" name="data_nascimento" id="data_nascimento"><br>

                <label for="tipo_documento">tipo de documento</label><br>
                <input type="text" name="tipo_documento" id="tipo_documento" required><br>

                <label for="documento">documento</label><br>
                <input type="text" name="documento" id="documento" required><br>

                <label for="cep">CEP</label><br>
                <input type="text" name="cep" id="cep" placeholder="00000-000"><br>

                <label for="cidade">Cidade</label><br>
                <input type="text" name="cidade" id="cidade" required><br>

                <label for="uf">UF</label><br>
                <input type="text" name="uf" id="uf" required><br>

                <label for="bairro">Bairro</label><br>
                <input type="text" name="bairro" id="bairro" required><br>

                <label for="rua">Rua</label><br>
                <input type="text" name="rua" id="rua" required><br>

                <label for="numero">Numero</label><br>
                <input type="text" name="numero" id="numero"><br>

                <label for="complemento">complemento</label><br>
                <input type="text" name="complemento" id="complemento"><br>

                <label for="">cep</label><br>
                <input type="text" name="" id=""><br>

                <label for="password">senha</label><br>
                <input type="password" name="password" id="password" required><br>

                <a href="login.php" style="color: #FF9900;">login</a><br>
                <input id="cadastro_submit" name="Cadastrar" type="submit" value="Confirmar">
            </form>
        </div>
    </main>
<?php
    require_once 'footer.php';
?>