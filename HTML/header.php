<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a class="navbar-brand" href="index.html">
                <img src="../images/casaicon.png" class="d-inline-block align-top" alt="">
            </a>
        
            <div class="d-flex align-items-center">
                <div id="criar_conta" class="me-3">
                    <a href="cadastro.php" class="btn btn-warning mb-0">CRIAR CONTA</a>
                    <img src="../images/login.png" alt="conta" id="conta_foto" class="ms-3">
                </div>
        
                 
            </div>
        </nav>
    </header>
    <nav id="navbar">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a id="navbar" class="active" href="index.php">Home</a></li>
            <li><a class="active" href="produtos.php">usados</a></li>
            <li><a href="escolhadeserviço.php">serviços</a></li>
            <li><a href="dicas.php">dicas</a></li>
        </ul>
    </nav>