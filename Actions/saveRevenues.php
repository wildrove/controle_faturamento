<?php
		require '../vendor/autoload.php';
		use Classes\DBConnection\DBConnection;
		use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

		

		/* Este trecho de código verifica se foi digitado caracteres diferentes de números e virgula */
		$arrayNumber = ['0','1','2','3','4','5','6','7','8','9',','];
		$arrayValue = $_POST['valor'];
		$arrayValue .= $_POST['valorPago'];
		$arrayValue .= $_POST['valorGlosa'];
		$arrayValue = str_split($arrayValue);
		$result = count(array_diff($arrayValue, $arrayNumber));
		/* ========================================= */

		if ($result != 0) {
			header("Location: ../alerts/invalidMoneyType.html");
			exit();
		}else{
			$arrayRevenues = is_array($_POST) ? $_POST : false;
		}

		foreach ($arrayRevenues as  $value) {
			if (empty($arrayRevenues['pago']) || empty($arrayRevenues['conciliado'])) {
				header("Location: ../alerts/inputEmpty.html");
				exit();
			}
		}

		$revenue = new ControleFaturamento();

		$insertedRevenue = $revenue->saveRevenue($arrayRevenues);

		if (count($insertedRevenue) > 0) {
			header("Location: ../alerts/revenueInserted.html");
		}else{
			header("Location: ../alerts/revenueNotInserted.html");
		}
		
	?>  
