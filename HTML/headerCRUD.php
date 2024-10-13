<!DOCTYPE html>
<html lang="pt-br">

<head>
<!DOCTYPE html>
    <title>Home</title>
    <link rel="stylesheet" href="../CSS/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const isLoggedIn = <?php echo isset($_SESSION['logado']) && $_SESSION['logado'] ? 'true' : 'false'; ?>;
            if (isLoggedIn) {
                const login = document.getElementById("login");
                const logout = document.getElementById("logout");
                const adminCrud = document.getElementById("adminCrud");
                const register = document.getElementById("register");

                if (login) {
                    login.remove();

                }
                
            }else{
                logout.remove();
                console.log("remove admin");
                adminCrud.remove();
                register.remove();
            }
        });
    </script>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            font-family: "Josefin Sans", sans-serif;
            font-style: normal;
        }

        a {
            text-decoration: none;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar d-flex justify-content-between align-items-center px-3">
            <a class="navbar-brand" href="index.php">
                <img src="../images/casaicon.png" class="d-inline-block align-top" alt="">
            </a>
            <div class="d-flex align-items-center">
                <div id="criar_conta" class="me-3">
                    <li class="btn btn-warning mb-0"><a href="cadastro.php" id="login-account">Criar Conta</a></li>
                    <img src="../images/login.png" alt="conta" id="conta_foto" class="ms-3">
                </div>
            </div>
        </nav>
    </header>
    <?php
        $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'NENHUM';  //definindo o nome do usuario em caso de nulo
    ?>
    <nav id="navbar">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
        <?php  
            if ($nome == "NENHUM"){
                echo '<li><a id="navbar" class="active" href="index.php">Home</a></li>';
            }else{
                echo '<li class="account" id="login"><a class="active" href="login.php" id="login-account">Olá, ' . htmlspecialchars($nome) . '</a></li>';
            } 
        ?>
            <li><a class="active" href="cliente.php">Cliente</a></li>
            <li><a class="active" href="compra.php">Compra</a></li>
            <li><a class="active" href="fornecedor.php">Fornecedor</a></li>
            <li><a class="active" href="itens_compra.php">Itens Compra</a></li>
            <li><a class="active" href="itens_os.php">Itens OS</a></li>
            <li><a class="active" href="itens_pedido.php">Itens Pedido</a></li>
            <li><a class="active" href="ordem_servico.php">Ordem Serviço</a></li>
            <li><a class="active" href="pedido.php">Pedido</a></li>
            <li><a class="active" href="produto.php">Produto</a></li>
            <li><a class="active" href="servico.php">Serviço</a></li>
        </ul>
    </nav>
</head>