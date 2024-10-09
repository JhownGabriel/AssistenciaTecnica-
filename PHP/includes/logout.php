<?php
    session_start();

    // Destrói a sessão 
    session_destroy();
    header('Location:../HTML/index.php');