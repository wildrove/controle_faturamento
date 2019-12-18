<?php
   	$convenio = ucfirst($_POST['convenio']);
   	$nFatura = intval($_POST['nFatura']);
   	$nFaturamento = intval($_POST['nFaturamento']);
   	$dtFechamento = $_POST['dtFechamento'];
   	$valor = floatval(str_replace(",",".", str_replace(".","",$_POST['valor'])));
   	$dtPossivelPagamento = $_POST['dtPossivelPagamento'];
   	$dtPagamento = $_POST['dtPagamento'];
	$pago = $_POST['pago'];
	$conciliado = $_POST['conciliado'];
	$valorPago = floatval(str_replace(",",".", str_replace(".","",$_POST['valorPago'])));
	$valorGlosa = floatval(str_replace(",",".", str_replace(".","",$_POST['valorGlosa'])));

	require 'vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
		
?>   	


<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">

    <title>Controle de Faturamento</title>
  </head>
  <body>
   	<div class="container">
   		<nav class="navbar navbar-expand-lg fixed-top navbar-header">
			<div class="navbar-brand img-fluid img-nav">
				<img src="./img/hospital-header-logo.png" width="" height="">
			</div>
		</nav>
		<section style="margin-top: 150px">
			<form class=" border rounded p-4 shadow-lg" method="post" action="" style="background-color: #ccc;">
	   			<h1 class="text-center pb-4">Controle de Faturamento a receber</h1>
	   			<div class="row"><!-- Linha 01 -->
	   				<div class="col"><!-- Coluna 01 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Convênio:</label>
	   						<input class="form-control" type="text" name="convenio" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 01 -->
	   				<div class="col"><!-- Coluna 02 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Nº Fatura:</label>
	   						<input class="form-control" type="text" name="nFatura" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 02 -->
	   				<div class="col"><!-- Coluna 03 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Nº Faturamento:</label>
	   						<input class="form-control" type="text" name="nFaturamento" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 03 -->
	   				<div class="col"><!-- Coluna 04 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Fechamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtFechamento" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 04 -->
	   				<div class="col"><!-- Coluna 05 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor R$:</label>
	   						<input class="form-control" type="money" name="valor" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 05 -->
	   			</div><!-- Fim linha 01 -->

	   			<div class="row"><!-- Linha 02 -->
	   				<div class="col"><!-- Coluna 06 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Possível Pagamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtPossivelPagamento" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 06 -->
	   				<div class="col"><!-- Coluna 07 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Pagamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtPagamento" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 07 -->
	   				<div class="col"><!-- Coluna 08 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Pago? (S/N)</label>
	   						<select class="form-control" name="pago" required="">
	   							<option value=""></option>
	   							<option class="font-weight-bold" value="SIM">SIM</option>
	   							<option class="font-weight-bold" value="NÃO">NÃO</option>
	   						</select>
	   					</div>
	   				</div><!-- Fim coluna 08 -->
	   				<div class="col"><!-- Coluna 09 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Conciliado? (S/N)</label>
	   						<select class="form-control" name="conciliado" required="">
	   							<option value=""></option>
	   							<option class="font-weight-bold" value="SIM">SIM</option>
	   							<option class="font-weight-bold" value="NÃO">NÃO</option>
	   						</select>
	   					</div>
	   				</div><!-- Fim coluna 09 -->
	   			</div><!-- Fim linha 02 -->

	   			<div class="row"><!-- Inicio linha 03 -->
	   				<div class="col-3"><!-- Coluna 10 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor Pago R$:</label>
	   						<input class="form-control" type="text" name="valorPago" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 10 -->
	   				<div class="col-3"><!-- Coluna 11 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor de Glosa R$:</label>
	   						<input class="form-control" type="text" name="valorGlosa" autocomplete="off" required="">
	   					</div>
	   				</div><!-- Fim coluna 11 -->
	   				<div class="col-3"><!-- Coluna 12 -->
	   					<div class="form-group">
	   						<button class="btn btn-primary form-control" type="submit" style="margin-top: 30px">Cadastrar</button>
	   					</div>
	   				</div><!-- Fim coluna 12 -->
	   			</div><!-- Fim linha 03 -->
	   		</form>	
		</section>	
   	</div>

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>