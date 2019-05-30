<?php
ini_set('display_erros',1);
include_once("Conn/index.php"); 
session_start();

try{
    //RECEBE OS DADOS DO FORM
    $salario = filter_input(INPUT_POST,'salariob');
    $nome = filter_input(INPUT_POST,'nome');
    $filhos = filter_input(INPUT_POST,'dependentes');

	var_dump($salario);

    //CÁLCULO DO VALE TRANSPORTE
	    $calculoVT = $salario * 0.06;
	    if($calculoVT > 192){
	        $valeTransporte = 192;
	    }else{
	        $valeTransporte = $salario * 0.06;
	    }

	    //CÁLCULO DO INSS
	    if($salario <= 1751.81){
	        $inss = $salario * 0.08;
	    }else if (($salario > 1751.81) && ($salario <= 2919.72)){
	        $inss = $salario * 0.09;
	    }else if (($salario >= 2919.73) && ($salario <= 5831.45)){
	        $inss = $salario * 0.11;
	    }else if ($salario > 5831.45){
	        $inss = 641.45;
	    }else {
	    	$inss = 0;
	    }

	    //BASE DE CALCULO
	   $baseCalculo = ($salario - $inss - ($filhos * 189.59));   
	    
	    //IRRF
	    if($baseCalculo < 1903.98){
	        $irrf = 0;
	    }else if(($baseCalculo >= 1903.99) && ($baseCalculo <= 2826.65)){
	        $irrf = (($baseCalculo * 0.075) - 142.80);
	    }else if(($baseCalculo >= 2826.66) && ($baseCalculo <= 3751.05)){
	        $irrf = (($baseCalculo * 0.15) - 354.80);
	    }else if(($baseCalculo >= 3751.06) && ($baseCalculo <= 4664.68)){
	        $irrf = (($baseCalculo * 0.225) - 636.13);
	    }else{
	        $irrf = (($baseCalculo * 0.275) - 869.36);
	    }
	    
	$descontos = $valeTransporte + $inss + $irrf;
	$salarioLiquido = $salario - $descontos;
    
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
        location.href='../listagem.html';</script>";
    }else{
        /*../View/BemVindo.php*/
        echo "<script>alert ('Revise os dados, por favor!')
        location.href='../index.html';</script>";
    }

}catch(PDOException $e){
    echo 'Mensagem de erro: '.$e->getMessage()."<br>";
    echo 'Nome do arquivo: '.$e->getFile()."<br>";
    echo 'Linha: '.$e->getLine()."<br>";
}



?>
