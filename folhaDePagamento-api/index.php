<?php
include_once("Conn/Conexao.php"); 
session_start();

try{
    //RECEBE OS DADOS DO FORM
    $salario = filter_input(INPUT_POST,'salariob');
    $nome = filter_input(INPUT_POST,'nome');
    $filhos = filter_input(INPUT_POST,'dependentes');

    //CÁLCULO DO VALE TRANSPORTE
    $calculoVT = $salario * 0.06;
    if($calculoVT > 192){
        $valeTransporte = 192;
        return $valeTransporte;
    }else{
        $valeTransporte = $salario * 0.06;
        return $valeTransporte;
    }

    //CÁLCULO DO INSS
    if($salario < 1751.81){
        $inss = $salario * 0.08;
        return $inss;
    }else if (($salario >= 1751.81) || ($salario <= 2919.72)){
        $inss = $salario * 0.09;
        return $inss;
    }else if (($salario >= 2919.73) || ($salario <= 5831.45)){
        $inss = $salario * 0.11;
        return $inss;
    }else if($salario >= 5831.45){
        $inss = 5831.45 * 0.11;
        return $inss;
    }else{
        return $inss;
    }

    //BASE DE CALCULO
    $baseCalculo = $salario - $inss - ($filhos * 189.59);   
    
    //IRRF
    if($salario < 1903.98){
        $irrf = 0;
        return $irrf;
    }else if(($salario >= 1903.99) || ($salario <= 2826.65)){
        $irrf = ($baseCalculo * 0.075) - 142.80;
        return $irrf;
    }else if(($salario >= 2826.66) || ($salario <= 3751.05)){
        $irrf = ($baseCalculo * 0.15) - 354.80;
        return $irrf;
    }else if(($salario >= 3751.06) || ($salario <= 4664.68)){
        $irrf = ($baseCalculo * 0.225) - 636.13;
        return $irrf;
    }else if($salario >= 4664.68){
        $irrf = ($baseCalculo * 0.275) - 869.36;
        return $irrf;
    }else{
        return $irrf;
    }

    //SALARIO LIQUIDO
    $salarioLiquido = $valeTransporte - $inss - $irrf;
    
    //INSERT DOS DADOS
    $sql = "INSERT INTO folhaDePagamento(cd_folha,nm_funcionario,qt_dependentes,vl_salario,vale_transporte,inss,irrf,vl_liquido) 
    VALUES(default,:nome, :dependentes, :salario, :vale, :inss, :irrf, :liquido)"; 
    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':nome',$nome);
    $stmt->bindParam(':dependentes',$filhos);
    $stmt->bindParam(':salario',$salario);
    $stmt->bindParam(':vale',$valeTransporte);
    $stmt->bindParam(':inss',$inss);
    $stmt->bindParam(':irrf',$irrf);
    $stmt->bindParam(':liquido',$salarioLiquido);


    $results = $stmt->execute();

    if ($results  != 0){
        echo "<script>alert('Calculado com sucesso!')
        location.href='../listagem.php';</script>";
    }else{
        /*../View/BemVindo.php*/
        echo "<script>alert ('Revise os dados, por favor!')
        location.href='../index.php';</script>";
    }

}catch(PDOException $e){
    echo 'Mensagem de erro: '.$e->getMessage()."<br>";
    echo 'Nome do arquivo: '.$e->getFile()."<br>";
    echo 'Linha: '.$e->getLine()."<br>";
}



?>