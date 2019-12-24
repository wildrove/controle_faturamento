<?php

   // pega a pagina atual
	$currentPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	//itens por página
	$itemsPerPage = 10;
   	// calcula o inicio da consulta
	$start = ($currentPage * $itemsPerPage) - $itemsPerPage;
	
	require '../vendor/autoload.php';
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$listRevenue = new ControleFaturamento();
   
   	// função de consulta no banco
	$resultPage = $listRevenue->selectAllRevenue($start, $itemsPerPage);

   	// função que pega o total de linhas no banco   
	$totalRowsQuery = $listRevenue->getTotalRevenues();
   	//calcula to total de paginas
	$totalPages = ceil($totalRowsQuery/$itemsPerPage);


	$previousPage = $currentPage -1;
	$nextPage = $currentPage + 1;
     
	?>
	<!DOCTYPE html>
	<html>
	<head>
	  <title>Listar Faturamento</title>
	  <meta charset="UTF-8">
		<!-- Bootstrap Local -->  
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	    <!-- Link Personal style.css -->
	    <link rel="stylesheet"  href="../bootstrap/css/style.css">

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="../bootstrap/js/bootstrap.min.js"></script>
	</head>
		<body>
			<nav class="navbar navbar-expand-lg fixed-top navbar-header">
				<div class="navbar-brand img-fluid img-nav">
					<img src="../img/hospital-header-logo.png" width="" height="">
				</div>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						
					</li>
				</ul>
			</nav>
			<div class="container-fluid">
            <h1 class="text-center mb-3" style="margin-top: 140px">Controle Faturamento</h1>    
            <div>
			    <table class="table shadow-lg table-hover table-striped table-bordered">
			    	<div class="d-flex justify-content-end">
			    		<form method="get" action="">
			    			<div class="form-group">
			    				<input type="text" class="form-control border rounded-right-0" name="userSearch" placeholder="nome do convenio" required="" maxlength="30" autocomplete="off">
			    			</div>
			    			<div class="form-group">
			    				<button type="submit" class="btn btn-primary border rounded-left-0">Pesquisar</button>
			    				<a href="exportXls.php" class="btn btn-primary" id="" name="export">Exportar</a>
			    				<a class="btn btn-primary " href="../index.php">Novo</a>
			    			</div>
			    		</form>
			    	</div>
			        <thead class="thead-dark">
			          <tr class="text-center" style="font-size: 15px">
			            <!--<th scope="col" class="border-right">ID</th>-->
			            <th scope="col" class="border-right">Convênio</th>
			            <th scope="col" class="border-right">Nº Fatura</th>
			            <th scope="col" class="border-right">Nº Faturamento</th>
			            <th scope="col" class="border-right">Data Fechamento</th>
			            <th scope="col" class="border-right">Valor</th>
			            <th scope="col" class="border-right">Possivel Pagamento</th>
			            <th scope="col" class="border-right">Data Pagamento</th>
			            <th scope="col" class="border-right">Pago</th>
			            <th scope="col" class="border-right">Conciliado</th>
			            <th scope="col" class="border-right">Valor Pago</th>
			            <th scope="col" class="border-right">Valor Glosa</th>
			            <th scope="col" class="border-right">Ação</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php 
			        foreach($resultPage as $value) {
			        		
			        		$dtPag = $value['DT_PAGAMENTO'] == "0000-00-00" ? "-" : date("d-m-Y", strtotime($value['DT_PAGAMENTO']));
							$dtPossivel = $value['DT_POSSIVEL_PAGAMENTO'] == "0000-00-00" ? "-" : date("d-m-Y", strtotime($value['DT_POSSIVEL_PAGAMENTO']));
							$dtFecham = $value['DT_FECHAMENTO'] == "0000-00-00" ? "-" : date("d-m-Y", strtotime($value['DT_FECHAMENTO']));
			            ?>
			            <tr class="text-center border font-italic" id="dvData">
			              <!--<th scope="row" class="border-right "><?php echo $value['ID_CONTROLE']; ?></th>-->
			              <td class="border-right"><?php echo $value['CONVENIO']; ?></td>
			              <td class="border-right"><?php echo $value['NUM_FATURA']; ?></td>
			              <td class="border-right"><?php echo $value['NUM_FATURAMENTO']; ?></td>
			              <td class="border-right"><?php  echo $dtFecham; ?></td>
			              <td class="border-right"><?php echo "R$ " . str_replace(".", ",", strval($value['VALOR'])); ?></td>
			              <td class="border-right"><?php echo $dtPossivel; ?></td>
			              <td class="border-right"><?php echo $dtPag; ?></td>
			              <td class="border-right"><?php if($value['PAGO'] == ""){echo "Não informado";} echo $value['PAGO']; ?></td>
			              <td class="border-right"><?php if($value['CONCILIADO'] == ""){echo "Não informado";} echo $value['CONCILIADO']; ?></td>
			              <td class="border-right"><?php echo "R$ " . str_replace(".", ",", strval($value['VL_PAGO'])); ?></td>
			              <td class="border-right"><?php echo "R$ " . str_replace(".", ", " ,strval($value['VL_GLOSA'])); ?></td>
			              <td class="border-right"><a class="btn btn-primary" href="editRevenue.php?idRevenue=<?php echo $value['ID_CONTROLE']; ?>">Editar</a></td>
			            </tr>
			            <?php
			        	}?>
			        </tbody>
			     </table>
            </div>
				<nav align="center" aria-label="Page navigation" style="margin-bottom: 20px;">
					<ul class="pagination mt-3">
					   <li class="page-item <?php if($previousPage == 0){ echo 'disabled';} ?>">
					   <?php 
					   if($previousPage != 0) { ?>
					      <a href="revenueList.php?page=<?php echo $previousPage; ?>" style="text-decoration: none;">
					         <span class="page-link bg-primary text-light" aria-hidden="true">Anterior</span>
					      </a>
					   <?php } else { ?>
					         <span class="page-link" >Anterior</span>
					   <?php } ?>
					   </li>
					   <?php

					        if($currentPage > 2){
					            echo "<li class='page-item'><span class='page-link' aria-hidden='true'>...</li>";
					        }
					        if($currentPage > 1){
					        echo "<li class='page-item'><a class='page-link' href='revenueList.php?page=".$previousPage."'>".$previousPage."</a></li>";
					        }
					        echo "<li class='page-item active'><a class='page-link' href=''>".$currentPage."</a></li>";
					        if($nextPage <= $totalPages){
					          echo "<li class='page-item'><a class='page-link' href='revenueList.php?page=".$nextPage ."'>".$nextPage."</a></li>"; 
					        }
					        if($nextPage < $totalPages){
					            echo "<li class='page-item'><span class='page-link' aria-hidden='true'>...</li>";
					        }
					        ?>
					      <li class="page-item <?php if($nextPage > $totalPages){echo 'disabled';} ?>">
					       <?php 
					       if($nextPage <= $totalPages) { ?>
					          <a href="revenueList.php?page=<?php echo $nextPage; ?>" aria-label="Previous" style="text-decoration: none">
					             <span class="page-link bg-primary text-light" aria-hidden="true">Próximo</span>
					          </a>
					       <?php } else { ?>
					          <span class="page-link" aria-hidden="true">Próximo</span>
					        <?php } ?>
					     </li>
					</ul>
				</nav>
				<a class="btn btn-primary  mb-5 shadow-lg" href="../index.php">Voltar</a>
			</div>
	</body>
</html>