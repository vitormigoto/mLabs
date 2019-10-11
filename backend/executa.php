<?php
	//API de Registro do Estacionamento
	require "api.php";
	
	$placa = strtoupper($_GET["placa"]);
	$id = $_GET["id"];
	$valor = $_GET["valor"]; 	
	$opcao = $_GET["opcao"];
	
	if($opcao=="entrada")
	{
		$retorno = entrada($placa);
		echo "	
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>	  
			<strong>ID de Registro: $retorno</strong>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			</button>
		</div>";
	}
	
	if($opcao=="saida")
	{
		$retorno = saida($id);
		echo "	
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>	  
			<strong>Tempo Registrado: $retorno</strong>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			</button>
		</div>";
	}
	
	if($opcao=="pagamento")
	{
		$retorno =  pagamento($id,$valor);
		echo "	
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>	  
			<strong>Status do Pagamento: $retorno</strong>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			</button>
		</div>";
	}
	
	if($opcao=="historico")
	{
		$retorno = historico($placa);
		echo "	
		<div class='alert alert-warning alert-dismissible fade show' role='alert'>	  
			<strong>Histórico de Registros</strong>
			<table class='table'>
			  <thead>
				<tr>
				  <th scope='col'>#</th>
				  <th scope='col'>Tempo Estacionado</th>
				  <th scope='col'>Status do Pagamento</th>
				</tr>
			  </thead>
			  <tbody>";
		for($x=0;$x<count($retorno);$x++)
		{			
			echo"
				<tr>
				  <th scope='row'>".$retorno[$x][0]."</th>
				  <td>".$retorno[$x][1]."</td>
				  <td>".$retorno[$x][2]."</td>
				</tr>";
		}
		echo"
			  </tbody>
			</table>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
			</button>
		</div>";
	}


?>