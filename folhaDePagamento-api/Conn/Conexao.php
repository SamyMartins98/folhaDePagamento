<?php
	try{
		$conexao = new PDO("mysql:host=localhost:3306;dbname=id9767236_folhacontabilidade","id9767236_contabilidade","the10sun");
		$conexao->exec('SET CHARACTER SET utf8');//Define o charset como UTF-8
	}   catch(PDOException $e){
			echo "Erro: ".$e->getMessage()."<br>";
			echo "Linha: ". $e->getLine()."<br>";
	}
?>