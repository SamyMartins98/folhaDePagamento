<?php
include_once("Conn/Conexao.php");
$folhas = $conexao->prepare("SELECT * FROM folhaDePagamento");
$folhas->execute();

while($folhas = $listaFolhas->fetch(PDO::FETCH_ASSOC))
	{?>
		<option value="<?php echo $folhas["cd_folha"]?>"><?php echo $folhas['nm_funcionario']." - ".$folhas['qt_dependentes']." - ".$folhas['vl_salario']." - ".$folhas['vale_transporte']." - ".$folhas['inss']." - ".$folhas['irrf']." - ".$folhas['vl_liquido']?>   
			</option><?php
		}?>  
