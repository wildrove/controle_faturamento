<?php
		require '../vendor/autoload.php';
		use Classes\DBConnection\DBConnection;
		use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

		$arrayRevenues = is_array($_POST) ? $_POST : false;

		$revenue = new ControleFaturamento();

		$revenue->saveRevenue($arrayRevenues);

	

		
	?>  
