<?php
    session_start();

    // Destrói a sessão 
    session_destroy();
    header('Location:../HTML/index.php');

    // if ($_SESSION['logado'] == false) {
//     header('Location:../index.php');
//     exit;
//    }



// if (!isset($_SESSION['logado']) || $_SESSION['logado'] === false) {
//     header('Location: ../index.php');
//     exit;
// }