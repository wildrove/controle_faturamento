
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="shortcut icon" href="img/hmslicon.ico" />


    <title>Controle de Faturamento</title>
  </head>
  <body>
   	<div class="container">
   		<nav class="navbar navbar-expand-lg fixed-top navbar-header">
			<div class="navbar-brand img-fluid img-nav">
				<img src="./img/hospital-header-logo.png" width="" height="">
			</div>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link text-light" href="Actions/revenueList.php">Visualizar Faturas</a>
				</li>
			</ul>
		</nav>
		<section style="margin-top: 150px">
			<form class=" border rounded p-4 shadow-lg" method="post" action="Actions/saveRevenues.php" style="background-color: #ccc;">
	   			<h1 class="text-center pb-4">Controle de Faturamento a receber</h1>
	   			<div class="row"><!-- Linha 01 -->
	   				<div class="col"><!-- Coluna 01 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Convênio:</label>
	   						<select  class="form-control" name="convenio" required="">
			    					<option value="" selected=""></option>
			    					<option value="Amil">AMIL</option>
			    					<option value="Copasa">COPASA</option>
			    					<option value="Bradesco">BRADESCO</option>
			    					<option value="Blue Life">BLUE LIFE</option>
			    					<option value="Cassi Banco do Brasil">CASSI BANCO DO BRASIL</option>
			    					<option value="Correios">CORREIOS</option>
			    					<option value="Gama Saude">GAMA SAÚDE</option>
			    					<option value="Golden Cross">GOLDEN CROSS</option>
			    					<option value="Nosamed">NOSAMED</option>
			    					<option value="Good Life">GOOD LIFE</option>
			    					<option value="Ipsemg">IPSEMG</option>
			    					<option value="Life System">LIFE SYSTEM</option>
			    					<option value="Porto Seguro">PORTO SEGURO</option>
			    					<option value="Promed">PROMED</option>
			    					<option value="Servidores Militares">SERVIDORES MILITARES</option>
			    					<option value="Complementar Exames Ocupacional">COMPLEMENTAR EXAMES OCUPACIONAL</option>
			    					<option value="Santa Casa">SANTA CASA</option>
			    					<option value="Serpram">SERPRAM</option>
			    					<option value="Unimed Sul Mineira">UNIMED SUL MINEIRA</option>
			    					<option value="Vitallis Saude">VITALLIS SAÚDE</option>
			    					<option value="SUS">SUS</option>
			    					<option value="Particular">PARTICULAR</option>
			    					<option value="Vital Medicina Ocupacional">VITAL MEDICINA OCUPACIONAL</option>
			    					<option value="Extremamedic">EXTREMAMEDIC</option>
			    					<option value="Notre Dame">NOTRE DAME</option>
			    					<option value="Trab Medic">TRAB MEDIC</option>
			    					<option value="Pandurata Alimentos">PANDURATA ALIMENTOS</option>
			    					<option value="Munhoz">MUNHOZ</option>
			    					<option value="Pref. Municipal de Extrema">PREF. MUNICIPAL DE EXTREMA</option>
			    					<option value="Prefeitura(Credenciamento)">PREFEITURA(CREDENCIAMENTO)</option>
			    					<option value="Vale Saude(SSBeneficios)">VALE SAÚDE(SSBENEFICIOS)</option>
			    					<option value="Brumed">BRUMED</option>
			    					<option value="Mtplus">MTPLUS</option>
			    					<option value="Mediservice Adm">MEDISERVICE ADM</option>
			    					<option value="Pref. Itapeva">PREF. ITAPEVA</option>
			    					<option value="Unimed Intercambio">UNIMD INTERCAMBIO</option>
			    					<option value="Prefeitura de Toledo">PREFEITURA DE TOLEDO</option>
			    					<option value="Vitalis Medisanitas Brasil">VITALIS MEDISANITAS BRASIL</option>
			    					<option value="Sul America Serviços Saude">SUL AMERICA SERVIÇOS SAUDE</option>
			    					<option value="Amha Saude S/A">AMHA SAUDE S/A</option>
			    					<option value="Sta - Saude,Segurança e Meio">STA - SAUDE,SEGURANÇA E MEIO</option>
			    					<option value="Samp Minas">SAMP MINAS</option>
			    					<option value="Elolife">ELOLIFE</option>
			    					<option value="Samp Minas">SAMP MINAS</option>
			    					<option value="Unimed Estancias Paulistas">UNIMED ESTANCIAS PAULISTAS</option>
			    					<option value="Notre Dame">NOTRE DAME</option>
			    					<option value="Santa Casa Camanducaia">SANTA CASA CAMANDUCAIA</option>
			    					<option value="Premium Saude">PREMIUM SAUDE</option>
			    					<option value="Plansaude">PLANSAUDE</option>
			    				</select>	
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
	   							<option value="" selected=""></option>
	   							<option class="font-weight-bold" value="SIM">SIM</option>
	   							<option class="font-weight-bold" value="NÃO">NÃO</option>
	   						</select>
	   					</div>
	   				</div><!-- Fim coluna 08 -->
	   				<div class="col"><!-- Coluna 09 -->
	   					<div class="form-group">
	   						<label class="font-weight-bold" for="convenio">Conciliado? (S/N)</label>
	   						<select class="form-control" name="conciliado">
	   							<option value="" selected=""></option>
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
	   						<input class="btn btn-primary form-control" type="submit" value="Cadastrar" style="margin-top: 30px">
	   					</div>
	   				</div><!-- Fim coluna 12 -->
	   				<div class="form-group">
	   					<input class="btn btn-primary form-control" type="" onclick="location.reload()" value="Cancelar" style="margin-top: 30px">
	   				</div><!-- Fim coluna 13 -->
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