<?php

// Configuração do Banco de Dados 
/**********************************************************
*****CONFIGURE OS DADOS DE CONEXÃO COM O SERVIDOR *********
**********************************************************/
$host = "localhost";
$user = "seu usuario";
$senha = "sua senha";

$banco = "estacionamento";
$con = mysqli_connect($host,$user,$senha,$banco);

//Lista de Erros
function erro($cod)
{
	$erro[1]="Padrão da Placa não atende os requisitos básicos (AAA-9999). Favor verificar e digitar corretamente!";
	$erro[2]="Erro ao processar o pagamento! Favor tentar efetuar novamente ou ao persistir o erro contatar o suporte.";
	$erro[3]="Erro de conexão com o Banco de Dados";
	$erro[4]="Registro não encontrado!";
	return $erro[$cod];
}

// Função de Registro de Entrada de Veículos - IN: Placa | OUT: Id de Reserva
function entrada($placa){

	if (preg_match("/^[A-Z]{3}\-[0-9]{4}$/", $placa))
	{		
		$sql_entrada = "INSERT INTO registros(placa,dthora_entrada) VALUES('$placa',NOW());";		
		$exe = mysqli_query($GLOBALS['con'],$sql_entrada);
		$id = mysqli_insert_id($GLOBALS['con']);
		$retorno = $id;
	}
	else
	{
		$retorno = erro(1);
	}
	
	mysqli_close($GLOBALS['con']);
	return $retorno;	
}

// Função de Registro de Saída de Veículos - IN: ID | OUT: Tempo estacionado
function saida($id)
{	

	$sql_saida = "UPDATE registros SET dthora_saida=NOW() WHERE id='$id'";
	$exe = mysqli_query($GLOBALS['con'],$sql_saida);	
	
	$sql_diferenca = "SELECT TIMEDIFF(dthora_saida,dthora_entrada) FROM registros WHERE id='$id'";
	$exe_diferenca = mysqli_query($GLOBALS['con'],$sql_diferenca);
	if(mysqli_num_rows($exe_diferenca)==0)
	{
		$retorno = erro(4);
	}
	else
	{
		$diferenca = mysqli_fetch_array($exe_diferenca);
		$retorno = $diferenca[0];
	}
		
	mysqli_close($GLOBALS['con']);
	return $retorno;
}

// Função de Registro de Pagamento - IN: ID / Valor Cobrado | OUT: Status Pagamento
function pagamento($id,$valor)
{
	$sql_pagamento = "UPDATE registros SET vlr_cobrado='$valor', status_pgto='PG' WHERE id='$id'";
	$exe_pagamento = mysqli_query($GLOBALS['con'],$sql_pagamento);	
	if(!$exe_pagamento)
	{
		$retorno = erro(2);
	}
	else
	{
		$retorno = "Pago";
	}	
	
	mysqli_close($GLOBALS['con']);
	return $retorno;
}

// Função de Retorno do Histórico por placa - IN: Placa | OUT: ID / Tempo de permanencia / Status Pagamento
function historico($placa)
{	
	if (preg_match("/^[A-Z]{3}\-[0-9]{4}$/", $placa))
	{		
		$sql_historico = "SELECT id,TIMEDIFF(dthora_saida,dthora_entrada),status_pgto FROM registros WHERE placa='$placa' ORDER BY dthora_entrada";
		$exe_historico = mysqli_query($GLOBALS['con'],$sql_historico);		
		if(mysqli_num_rows($exe_historico)==0)
		{			
			$retorno = erro(4);
		}
		else
		{
			$count=0;
			while($resultados = mysqli_fetch_array($exe_historico))
			{					
					$valores[$count][0]="$resultados[0]";
					$valores[$count][1]="$resultados[1]";
					if($resultados[2]=="PG")
						$resultados[2]="Pago";
					else
						$resultados[2]="Não Pago";
					$valores[$count][2]="$resultados[2]";
					$count++;
			}
			$retorno = $valores;
		}
	}
	else
	{
		$retorno = erro(1);
	}
	
	mysqli_close($GLOBALS['con']);
	return $retorno;
}



?>