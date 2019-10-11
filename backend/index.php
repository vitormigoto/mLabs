<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Teste Estacionamento</title>
  </head>
  <body >
    
	
	<div class="container p-4">
	
	<h1>Sistema de Estacionamento</h1>
	<div id="resposta">
	</div>
	
	<div class='row'>
		<div class="card m-2">
			<div class="card-header">
				Registrar Entrada de Veículos
			</div>
			<div class="card-body">				
				<div class="form-group">
					<label for="txt_placa">Placa do Carro</label>
					<input type="text" class="form-control" name="placa" onkeyup="this.value = this.value.toUpperCase();" id="txt_placa" aria-describedby="txt_placa" placeholder="Digite a Placa do Carro">
				</div>
				<button type="button"  onclick="envia('entrada',document.getElementById('txt_placa').value);" class="btn btn-primary">Registrar Entrada</button>
			</div>
		</div>
		
		<div class="card m-2">
			<div class="card-header">
				Registrar Saída de Veículos
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="txt_idsaida">ID de Registro</label>
					<input type="number" class="form-control" name="id"  id="txt_idsaida" aria-describedby="txt_idsaida" placeholder="Digite a ID de Registro">
				</div>
				<button type="button"  onclick="envia('saida','',document.getElementById('txt_idsaida').value);" class="btn btn-primary">Registrar Saída</button>
			</div>
		</div>
	</div>
	<div class='row'>	
		<div class="card m-2">
			<div class="card-header">
				Registrar Pagamento de Veículos
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="txt_idpgto">ID Registro</label>
					<input type="number" class="form-control" name="idpgto"  id="txt_idpgto" aria-describedby="txt_idpgto" placeholder="Digite a ID de Registro">
				</div>
				<div class="form-group">
					<label for="txt_valor">Valor Pago</label>
					R$ <input type="number" class="form-control" name="valor" id="txt_valor" aria-describedby="txt_valor" placeholder="Valor a ser Pago">
				</div>
				<button type="button" onclick="envia('pagamento','',document.getElementById('txt_idpgto').value,document.getElementById('txt_valor').value);" class="btn btn-primary">Registrar Pagamento</button>
			</div>
		</div>
		
		<div class="card m-2">
			<div class="card-header">
				Histórico por Placas
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="txt_placa2">Placa do Carro</label>
					<input type="text" class="form-control" name="placa" onkeyup="this.value = this.value.toUpperCase();" id="txt_placa2" aria-describedby="txt_placa2" placeholder="Digite a Placa do Carro">
				</div>
				<button type="button"  onclick="envia('historico',document.getElementById('txt_placa2').value);" class="btn btn-primary">Pesquisar Histórico</button>
			</div>
		</div>
	</div>

	</div>
    <!-- Optional JavaScript -->	
	<script>
	function envia(opcao,placa,id,valor){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			document.getElementById("resposta").innerHTML += this.responseText;
		  }
		};
		xmlhttp.open("GET", "executa.php?opcao="+opcao+"&placa="+placa+"&id="+id+"&valor="+valor, true);
		xmlhttp.send();		
	}			
	</script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>