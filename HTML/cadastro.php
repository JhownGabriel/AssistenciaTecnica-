<?php
include_once '../includes/auth.php';
// Incluindo o arquivo de conexão com o banco de dados
include_once '../includes/dbconnect.php';

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
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='../index.php';</script>";
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
            <form action="index.html">
                <div id="logo"><img src="../images/logoazul.png" alt="logo"></div>
                <h1>Cadastro</h1>
                <hr>
                <label for="">nome</label><br>
                <input type="text"><br>

                <label for="">email</label><br>
                <input type="email" name="" id=""><br>

                <label for="">telefone</label><br>
                <input type="email" name="" id=""><br>

                <label for="">celular</label><br>
                <input type="text" name="" id=""><br>

                <label for="">data de nascimento</label><br>
                <input type="date" name="" id=""><br>

                <label for="">tipo de documento</label><br>
                <input type="text" name="" id=""><br>

                <label for="">documento</label><br>
                <input type="text" name="" id=""><br>

                <label for="">uf</label><br>
                <input type="cidade" name="" id=""><br>

                <label for="">bairro</label><br>
                <input type="text" name="" id=""><br>

                <label for="">rua</label><br>
                <input type="text" name="" id=""><br>

                <label for="">numero</label><br>
                <input type="text" name="" id=""><br>

                <label for="">complemento</label><br>
                <input type="text" name="" id=""><br>

                <label for="">cep</label><br>
                <input type="text" name="" id=""><br>

                <label for="">senha</label><br>
                <input type="text" name="" id=""><br>

                <a href="login.html" style="color: #FF9900;">login</a><br>
                <input id="confirma" type="button" value="Confirmar">
            </form>
        </div>
    </main>
<?php
    require_once 'footer.php';
?>