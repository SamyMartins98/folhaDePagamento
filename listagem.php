<?php
session_start();
include("folhaDePagamento-api/Conn/index.php");
$resultado_folha = $conexao->query("SELECT * FROM folhaDePagamento",PDO::FETCH_ASSOC);
$resultado_folha->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 	<meta name="viewport" content="width=device-width, initial-scale=1"/>
  	<title>Listagem</title>
  	<link rel="icon" href="img/icon.png">
  	<!-- CSS  -->
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<nav class="blue lighten-2">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo logonav"><img src="img/icon.png" style="width: 40px; height: 40px;"></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.html">Folha de pagamento</a></li>
            <li><a href="listagem.php">Listagem</a></li>
          </ul>
        </div>
      </nav>
      <div class="container">
	 		<div class="row">
	 			<div class="col s12 m4">
					 <table class="striped">
					 	
				        <thead>
				          <tr>
				          	  <th>Código</th>
				              <th>Nome</th>
				              <th>Dependentes</th>
				              <th>Salário bruto</th>
				              <th>Vale transporte</th>
				              <th>INSS</th>
				              <th>IRRF</th>
				              <th>Salário liquído</th>

				          </tr>
				        </thead>

				        <tbody>
                        <?php while($rows_folhas = $resultado_folha->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<td><?php echo $rows_folhas['cd_folha']; ?></td>
								<td><?php echo $rows_folhas['nm_funcionario']; ?></td>
								<td><?php echo $rows_folhas['qt_dependentes']; ?></td>
								<td><?php echo $rows_folhas['vl_salario']; ?></td>
                                <td><?php echo $rows_folhas['vale_transporte']; ?></td>
                                <td><?php echo $rows_folhas['inss']; ?></td>
                                <td><?php echo $rows_folhas['irrf']; ?></td>
                                <td><?php echo $rows_folhas['vl_liquido']; ?></td>
							</tr>
							<?php } ?>

				        </tbody>
				      </table>
				 	 </div>
				</div>
			</div>

</body>
</html>
