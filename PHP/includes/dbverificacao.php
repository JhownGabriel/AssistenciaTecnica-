<?php
    include_once 'dbconnect.php';
    $mysqli = new mysqli("localhost", "root", "", "AssistenciaTecnica");
    
    // vai checar a conexão e se der falha vai mostrar um erro
    if ($mysqli->connect_errno) {
        die("Falha ao conectar ao Banco de Dados: " . $mysqli->connect_error);
    }