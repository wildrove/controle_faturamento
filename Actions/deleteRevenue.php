<?php
	require '../vendor/autoload.php';
	use Classes\Faturamento\ControleFaturamento\ControleFaturamento;

	$deleteRevenue = new ControleFaturamento();

	$idToRemove = isset($_GET['idRevenue']) ? intval($_GET['idRevenue']) : "";

	// função para remover um ID
	$result = $deleteRevenue->deleteRevenue($idToRemove);
	// função que verifica ID removido
	$rows = $deleteRevenue->selectIdRemoved($idToRemove);

	// condição para retornar mensagem de sucesso
	if ($rows > 0) {
		header("Location: ../alerts/errorToDelete.html");
		exit();
	}else {
		header("Location: ../alerts/revenueDeleted.html");
	}
	