<?php
	
	require '../vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$list = new ControleFaturamento();

	echo "<pre>";
	print_r($list->selectAllRevenue());