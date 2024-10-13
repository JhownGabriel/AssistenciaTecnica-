<?php
$localhost = "31.170.167.153";
    $username = "u335479363_alunos4";
    $password = '$en4C2024';
    $dbname = "u335479363_alunos4";
     $mysqli = mysqli_connect($localhost, $username, $password, $dbname);
    if($mysqli->connect_error) {   
        die("connect failed: " .$mysqli->connect_error); }