
<html lang="en">
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
			<form class=" border rounded p-4 bg-light-75" method="post" action="">
	   			<h1 class="text-center pb-4">Controle de Faturamento a receber</h1>
	   			<div class="row"><!-- Linha 01 -->
	   				<div class="col"><!-- Coluna 01 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Convênio:</label>
	   						<input class="form-control" type="text" name="convenio" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 01 -->
	   				<div class="col"><!-- Coluna 02 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Nº Fatura:</label>
	   						<input class="form-control" type="text" name="nFatura" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 02 -->
	   				<div class="col"><!-- Coluna 03 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Nº Faturamento:</label>
	   						<input class="form-control" type="text" name="nFaturamento" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 03 -->
	   				<div class="col"><!-- Coluna 04 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Fechamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtFechamento" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 04 -->
	   				<div class="col"><!-- Coluna 05 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor R$:</label>
	   						<input class="form-control" type="text" name="valor" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 05 -->
	   			</div><!-- Fim linha 01 -->

	   			<div class="row"><!-- Linha 02 -->
	   				<div class="col"><!-- Coluna 06 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Possível Pagamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtPossivelPagamento" autocomplete="off" >
	   					</div>
	   				</div><!-- Fim coluna 06 -->
	   				<div class="col"><!-- Coluna 07 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Data Pagamento:</label>
	   						<input class="form-control" type="date" min="1900-01-01" max="2200-01-01" name="dtPagamento" autocomplete="off" >
	   					</div>
	   				</div><!-- Fim coluna 07 -->
	   				<div class="col"><!-- Coluna 08 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Pago? (S/N)</label>
	   						<select class="form-control" name="pago">
	   							<option value=""></option>
	   							<option class="font-weight-bold" value="SIM">SIM</option>
	   							<option class="font-weight-bold" value="NÃO">NÃO</option>
	   						</select>
	   					</div>
	   				</div><!-- Fim coluna 08 -->
	   				<div class="col"><!-- Coluna 09 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Conciliado? (S/N)</label>
	   						<select class="form-control" name="conciliado">
	   							<option value=""></option>
	   							<option class="font-weight-bold" value="SIM">SIM</option>
	   							<option class="font-weight-bold" value="NÃO">NÃO</option>
	   						</select>
	   					</div>
	   				</div><!-- Fim coluna 09 -->
	   			</div><!-- Fim linha 02 -->

	   			<div class="row"><!-- Inicio linha 03 -->
	   				<div class="col"><!-- Coluna 10 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor Pago R$:</label>
	   						<input class="form-control" type="text" name="valorPago" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 10 -->
	   				<div class="col"><!-- Coluna 11 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Valor de Glosa R$:</label>
	   						<input class="form-control" type="text" name="valorGlosa" autocomplete="off">
	   					</div>
	   				</div><!-- Fim coluna 11 -->
	   				<div class="col"><!-- Coluna 12 -->
	   					<div class="form-group">
	   						<button class="btn btn-primary form-control" type="submit" style="margin-top: 30px">Cadastrar</button>
	   					</div>
	   				</div><!-- Fim coluna 12 -->
	   			</div><!-- Fim linha 03 -->
	   		</form>	
		</section>	
   	</div>

   	<?php

		$pago = $_POST['pago'];
		$conciliado = $_POST['conciliado'];

		if ($pago == "" || $conciliado == "") { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  Os campos pago e conciliado não pode ser vazio.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
		<?php } else{
			echo $pago . '<br>';
			echo $conciliado;
		} ?>	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>