<?php
require '../vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$validateEdit = new ControleFaturamento();

	$arrayEdit = $_POST;

	if(count($validateEdit->saveRevenue($arrayEdit)) != 0){
		header("Location: ../alerts/revenueInserted.html");
		exit();
	}else{
		header("Location: ../alerts/revenueNotInserted.html");
		exit();
	}