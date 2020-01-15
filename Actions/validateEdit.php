<?php
require '../vendor/autoload.php';
	use Classes\DBConnection\DBConnection;
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$validateEdit = new ControleFaturamento();

	$arrayEdit = $_POST;

	// Verifica se a função saveRevenue() está retornando algum ID
	if(count($validateEdit->saveRevenue($arrayEdit)) != 0){
		header("Location: ../alerts/revenueEdited.html");
		exit();
	}else{
		header("Location: ../alerts/revenueNotInserted.html");
		exit();
	}