<?php
	
	require '../vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;



   // pega a pagina atual
	$currentPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 0;
	//itens por página
	$itemsPerPage = 5;
   	// calcula o inicio da consulta
	$start = ($currentPage * $itemsPerPage) - $itemsPerPage;

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
			<div class="container-fluid">
            <h1 class="text-center mb-3" style="margin-top: 140px">Controle Faturamento</h1>    
            <div>
			    <table class="table shadow-lg table-hover table-striped table-bordered">
			    	<div class="d-flex justify-content-end">
			    		<form method="get" action="">
			    			<div class="form-group">
			    				<input type="text" class="form-control border rounded-right-0" name="userSearch" placeholder="nome de usuário" required="" maxlength="30" autocomplete="off">
			    			</div>
			    			<div class="form-group">
			    				<button type="submit" class="btn btn-primary border rounded-left-0">Pesquisar</button>
			    				<a href="" class="btn btn-primary" id="" name="export">Exportar</a>
			    			</div>
			    		</form>
			    	</div>
			        <thead class="thead-dark">
			          <tr class="text-center" style="font-size: 15px">
			            <th scope="col" class="border-right">ID</th>
			            <th scope="col" class="border-right">CONVÊNIO</th>
			            <th scope="col" class="border-right">Nº FATURA</th>
			            <th scope="col" class="border-right">Nº FATURAMENTO</th>
			            <th scope="col" class="border-right">DATA FECHAMENTO</th>
			            <th scope="col" class="border-right">VALOR</th>
			            <th scope="col" class="border-right">POSSIVEL PAGAMENTO</th>
			            <th scope="col" class="border-right">DATA PAGAMENTO</th>
			            <th scope="col" class="border-right">PAGO</th>
			            <th scope="col" class="border-right">CONCILIADO</th>
			            <th scope="col" class="border-right">VALOR PAGO</th>
			            <th scope="col" class="border-right">VALOR GLOSA</th>
			          </tr>
			        </thead>
			        <tbody>
			        <?php 
			        foreach($resultPage as $rowUser) {

			            ?>
			            <tr class="text-center border font-italic" id="dvData">
			              <th scope="row" class="border-right "><?php echo $rowUser['ID_CONTROLE']; ?></th>
			              <td class="border-right"><?php echo utf8_decode($rowUser['CONVENIO']); ?></td>
			              <td class="border-right"><?php echo $rowUser['NUM_FATURA']; ?></td>
			              <td class="border-right"><?php echo $rowUser['NUM_FATURAMENTO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['DT_FECHAMENTO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['VALOR']; ?></td>
			              <td class="border-right"><?php echo $rowUser['DT_POSSIVEL_PAGAMENTO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['DT_PAGAMENTO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['PAGO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['CONCILIADO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['VL_PAGO']; ?></td>
			              <td class="border-right"><?php echo $rowUser['VL_GLOSA']; ?></td>
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
				<a class="btn btn-primary  mb-5 shadow-lg" href="">Voltar</a>
			</div>
	</body>
</html>