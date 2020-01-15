<?php

	require '../vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$idRevenue = intval($_GET['idRevenue']);

	$editRevenue = new ControleFaturamento();

	$revenue = $editRevenue->getRevenueById($idRevenue);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Controle de Faturamento</title>
	 <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Local -->  
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Link Personal style.css -->
    <link rel="stylesheet"  href="../bootstrap/css/style.css">

     <!-- Fontawesome link -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css">
        
</head>
	<body>
  		<div class="container">
  			<nav class="navbar navbar-expand-lg fixed-top navbar-header">
				<div class="navbar-brand img-fluid img-nav">
					<img src="../img/hospital-header-logo.png" width="" height="">
				</div>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						
					</li>
				</ul>
			</nav>
  			<?php foreach ($revenue as $rowRevenue) { ?>

  			<form style="margin-top: 150px;" action="validateEdit.php" method="post">
  				<h1 class="text-center mb-3">Editar Faturamento</h1>
  				  <div class="form-group">
  				  	<input type="hidden" class="form-control" name="idControle" value="<?php echo $rowRevenue['ID_CONTROLE']; ?>">
  				  </div>	
				  <div class="form-row font-weight-bold">
				    <div class="form-group col-md-6">
				      <label for="">Nome convênio:</label>
				      <input type="text" class="form-control"  name="convenio" id="" value="<?php echo $rowRevenue['CONVENIO']; ?>">
				    </div>
				    <div class="form-group col-md-6">
				      <label for="">Nº Fatura:</label>
				      <input type="text" class="form-control"  name="nFatura" id="" value="<?php echo $rowRevenue['NUM_FATURA']; ?>">
				    </div>
				  </div><!-- Fim linha 1 -->
				  <div class="form-row font-weight-bold">
				  	<div class="form-group col-md-6">
				    	<label for="">Nº Faturamento:</label>
				    	<input type="text" class="form-control" name="nFaturamento" id="" value="<?php echo $rowRevenue['NUM_FATURAMENTO']; ?>">
				  	</div>
				  	<div class="form-group col-md-6">
				    	<label for="">Data Fechamento:</label>
				    	<input type="date" class="form-control" name="dtFechamento" id="" value="<?php echo $rowRevenue['DT_FECHAMENTO']; ?>">
				  	</div>
				  </div><!-- Fim linha 2 -->
				  <div class="form-row font-weight-bold">
				  	<div class="form-group col-md-6">
				    	<label for="">Valor:</label>
				    	<input type="text" class="form-control"  name="valor" id="" value="<?php echo $rowRevenue['VALOR']; ?>">
				  	</div>
				  	<div class="form-group col-md-6">
				    	<label for="">Possivel Pagamento:</label>
				    	<input type="date" class="form-control"  name="dtPossivelPagamento" id="" value="<?php echo $rowRevenue['DT_POSSIVEL_PAGAMENTO']; ?>">	
				    </div>
				  </div><!-- Fim linha 3 -->
				  <div class="form-row font-weight-bold">
				  	<div class="form-group col-md-6">
				    	<label for="">Data Pagamento:</label>
				    	<input type="date" class="form-control"  name="dtPagamento" id="" value="<?php echo $rowRevenue['DT_PAGAMENTO']; ?>">
				  	</div>
				  	<div class="form-group col mt-4">
				    	<label for="">Pago:</label>
				    	<select name="pago">
				    		<option class="form-control" value=""></option>
				    		<option class="form-control" value="SIM" selected="">SIM</option>
				    		<option class="form-control" value="NÃO">NÃO</option>
				    	</select>
				  	</div>
				  	<div class="form-group col mt-4">
				    	<label for="">Conciliado:</label>
				    	<select name="conciliado">
				    		<option class="form-control" value=""></option>
				    		<option class="form-control" value="SIM" selected="">SIM</option>
				    		<option class="form-control" value="NÃO">NÃO</option>
				    	</select>
				  	</div>
				  </div><!-- Fim Linha 4 -->
				  <div class="form-row font-weight-bold">
				  	<div class="form-group col-md-6">
				  		<label for="">Valor Pago:</label>
				  		<input class="form-control" type="text" name="valorPago" value="<?php echo $rowRevenue['VL_PAGO']; ?>">
				  	</div>
				  	<div class="form-group col-md-6">
				  		<label for="">Valor Glosa:</label>
				  		<input class="form-control" type="text" name="valorGlosa" value="<?php echo $rowRevenue['VL_GLOSA']; ?>">
				  	</div>
				  </div><!-- Fim Linha 5 -->  	
				  <div style="margin-bottom: 30px;">
				  	<button type="submit" class="btn btn-primary">Salvar</button>
				  	<a class="btn btn-primary ml-3" href="javascript:history.back()">Voltar</a>
				  </div>
			</form>
  		</div>
  	<?php }
  	 ?>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     	<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>