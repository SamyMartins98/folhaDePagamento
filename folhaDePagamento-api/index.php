<?php
include_once("../Conn/index.php"); 
session_start();

    $salario = filter_input(INPUT_POST,'salariob');
    $nome = filter_input(INPUT_POST,'nome');


?>