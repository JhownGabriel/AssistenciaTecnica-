<?php
session_start();

if (isset($_SESSION['logado'])) {
    header('Location:../index.php');
    exit;
}
?>
<?php
    include_once '../PHP/includes/db_connect.php'; // Incluindo a conexão com o banco
    
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Verifica se os campos estão preenchidos
        if (empty($email)) {
            echo "<p>E-mail é obrigatório.</p>";
        } elseif (empty($password)) {
            echo "<p>Senha é obrigatória.</p>";
        } else {
            // Prepara a consulta
            $stmt = $mysqli->prepare("SELECT id_usu, nome_usu FROM `Usuario` WHERE email_usu = ? AND senha = ?");
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o usuário existe 
            if ($result->num_rows > 0) {
                // Busca os dados do usuário
                $user = $result->fetch_assoc(); // Armazena os dados do usuário
                $_SESSION['logado'] = true; // Marcar como logado
                $_SESSION['nome'] = $user['nome_usu']; // nome do usuário na sessão
                $id = $user['id_usu']; // ID do usuário na sessão
                $_SESSION['id'] = $id;
    
                // Redireciona após o login
                echo '<script>window.location.href = "../index.php";</script>';
                exit;
            } else {
                echo "<p>E-mail ou senha incorretos.</p>";
            }

        }
    }
    ?>
<?php
    require_once 'header.php';
?>
    <main>
        <div>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" 
            method="post" id="form_login">
                <div id="logo"><img src="../images/logoazul.png" alt="logo"></div>
                <h1>Login</h1>
                <hr>
                <label for="email">email</label><br>
                <input type="email" name="email" id="emai;"><br>
                <label for="password">senha</label><br>
                <input type="password" name="password" id="password"><br>
                <input type="checkbox" name="" id=""><p>manter logado</p>
                <input id="confirma" type="button" value="logar">
                <p id="senharecovery">esqueci a senha</p>
            </form>
        </div>
    </main>
    <?php
        require_once 'footer.php';
    ?>