<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Redireciona para a página de login se não estiver logado
    header('Location: ../login.php');
    exit;
}
?>