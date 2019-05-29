<?php
	try{
		$conexao = new PDO("mysql:host=localhost;dbname=contabilidade","","");
		$conexao->exec('SET CHARACTER SET utf8');//Define o charset como UTF-8
	}   catch(PDOException $e){
			echo "Erro: ".$e->getMessage()."<br>";
			echo "Linha: ". $e->getLine()."<br>";
	}
?>