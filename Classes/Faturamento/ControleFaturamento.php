<?php
namespace Classes\Faturamento\ControleFaturamento;
	
	use Classes\DBConnection\DBConnection;
	use PDO;
	
	class ControleFaturamento {

		public $connection = null;
		private $idControle;
		private $convenio;
		private $nFatura;
		private $nFaturamento;
		private $dtFechamento;
		private $valor;
		private $dtPossivelPagamento;
		private $dtPagamento;
		private $pago;
		private $conciliado;
		private $valorPago;
		private $valorGlosa;

		public function __construct()
		{
			$this->connection = new DBConnection();
		}

		public function __get($atribute)
		{
			return $this->$atribute;
		}

		public function __set($value, $atribute)
		{
			$this->$atribute = $value;
		}

		public function saveRevenue(array $revenue)
		{
			
			foreach ($revenue as  $value) {
				$this->idControle = array_key_exists("idControle", $revenue) ? intval($revenue['idControle']) : 0;
				$this->convenio = isset($revenue['convenio']) ? mb_convert_case($revenue['convenio'], MB_CASE_TITLE, 'UTF-8') : "Não informado";
				$this->nFatura = isset($revenue['nFatura']) ? intval($revenue['nFatura']) : 0;
				$this->nFaturamento = isset($revenue['nFaturamento']) ? $revenue['nFaturamento'] : "-";
				$this->dtFechamento = isset($revenue['dtFechamento']) ? $revenue['dtFechamento'] : "00-00-0000";
				$this->valor = !empty($revenue['valor']) ? strval(preg_replace('#\D#',"", $revenue['valor'])/100) : "0";
				$this->valor = !empty($this->valor) ? str_replace(".", ",", $this->valor) : "0";
				$this->dtPossivelPagamento = isset($revenue['dtPossivelPagamento']) ? $revenue['dtPossivelPagamento'] : "00-00-0000";
				$this->dtPagamento = isset($revenue['dtPagamento']) ? $revenue['dtPagamento'] : "00-00-0000";
				$this->pago = !empty($revenue['pago']) ? strtoupper($revenue['pago']) : "-";
				$this->conciliado = !empty($revenue['conciliado']) ? strtoupper($revenue['conciliado']) : "-";
				$this->valorPago = !empty($revenue['valorPago']) ? strval(preg_replace('#\D#',"", $revenue['valorPago'])/100) : "0";
				$this->valorPago = !empty($this->valorPago) ? str_replace(".", ",", $this->valorPago) : "0";
				$this->valorGlosa = !empty($revenue['valorGlosa']) ? strval(preg_replace('#\D#',"", $revenue['valorGlosa'])/100) : "0";
				$this->valorGlosa = !empty($this->valorGlosa) ? str_replace(".", ",", $this->valorGlosa) : "0";
			}


			$sqlEdit = "UPDATE controle_faturamento.tb_controle
					SET CONVENIO = :convenio,
						NUM_FATURA = :nFatura,
						NUM_FATURAMENTO = :nFaturamento,
						DT_FECHAMENTO = :dtFechamento,
						VALOR = :valor,
						DT_POSSIVEL_PAGAMENTO = :dtPossivelPagamento,
						DT_PAGAMENTO = :dtPagamento,
						PAGO = :pago,
						CONCILIADO = :conciliado,
						VL_PAGO = :valorPago,
						VL_GLOSA = :valorGlosa
					WHERE ID_CONTROLE = $this->idControle";

			$sqlInsert = "INSERT INTO controle_faturamento.tb_controle VALUES(NULL, :convenio, :nFatura, :nFaturamento , :dtFechamento, :valor, :dtPossivelPagamento, :dtPagamento, :pago, :conciliado, :valorPago, :valorGlosa)";

			$data = "";
			if($this->idControle > 0 ){
				$data = $this->connection->conn->prepare($sqlEdit);
			}else{
				$data = $this->connection->conn->prepare($sqlInsert);
			}

			$data->bindParam(':convenio', $this->convenio, PDO::PARAM_STR);
			$data->bindParam(':nFatura', $this->nFatura, PDO::PARAM_INT);
			$data->bindParam(':nFaturamento', $this->nFaturamento, PDO::PARAM_STR);
			$data->bindParam(':dtFechamento', $this->dtFechamento, PDO::PARAM_STR);
			$data->bindParam(':valor', $this->valor, PDO::PARAM_STR);
			$data->bindParam(':dtPossivelPagamento', $this->dtPossivelPagamento, PDO::PARAM_STR);
			$data->bindParam(':dtPagamento', $this->dtPagamento, PDO::PARAM_STR);
			$data->bindParam(':pago', $this->pago, PDO::PARAM_STR);
			$data->bindParam(':conciliado', $this->conciliado, PDO::PARAM_STR);
			$data->bindParam(':valorPago', $this->valorPago, PDO::PARAM_STR);
			$data->bindParam(':valorGlosa', $this->valorGlosa, PDO::PARAM_STR);
			$data->execute();

			$lastId = $this->connection->conn->lastInsertId();

			if(!empty($this->idControle)){
				return $this->idControle;
			}else{
				return intval($lastId);
			}
			
		}

		public function selectAllRevenue($page, $limit)
		{
			try{
				$sql = "SELECT * FROM controle_faturamento.tb_controle ORDER BY ID_CONTROLE ASC LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);

				return $result;

			}catch(Exception $e){
				echo $e->getMessage();
			}
		}

		public function getTotalRevenues()
		{
			$sql = "SELECT * FROM Controle_faturamento.tb_controle";
			$data = $this->connection->conn->prepare($sql);
			$data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			return $result = count($result);
		}

		public function getTotalRevenueFilter($arrayRevenue)
		{
			foreach($arrayRevenue as $value) {
				
				$this->convenio = array_key_exists("convenioFiltro", $arrayRevenue)  ? $arrayRevenue['convenioFiltro'] : "";
				$this->pago = array_key_exists("pagoFiltro", $arrayRevenue) ? strtoupper($arrayRevenue['pagoFiltro']) : "";
				$this->conciliado = array_key_exists("conciliadoFiltro", $arrayRevenue) ? strtoupper($arrayRevenue['conciliadoFiltro']) : "";
				$this->valorPago = array_key_exists("valorPagoFiltro", $arrayRevenue) ? $arrayRevenue['valorPagoFiltro'] : "";
				$this->dtFechamento = array_key_exists("dtFechaFiltro", $arrayRevenue)  ? $arrayRevenue['dtFechaFiltro'] : "";
				$this->dtPagamento = array_key_exists("dtPagaFiltro", $arrayRevenue) ? $arrayRevenue['dtPagaFiltro'] : "";
				$this->nFatura = array_key_exists("nFaturaFiltro", $arrayRevenue) ? intval($arrayRevenue['nFaturaFiltro']) : "";
			}

			$sql;
			$data;

			if (!empty($this->convenio)) {
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE CONVENIO = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->convenio);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);

			}elseif(!empty($this->pago)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE PAGO = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->pago);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);

			}elseif(!empty($this->conciliado)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE CONCILIADO = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->conciliado);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);

			}elseif(!empty($this->valorPago)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE VL_PAGO = ? ";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->valorPago);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return conut($result);

			}elseif(!empty($this->dtFechamento)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE DT_FECHAMENTO = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->dtFechamento);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);

			}elseif(!empty($this->dtPagamento)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE DT_PAGAMENTO = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->dtPagamento);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);

			}elseif(!empty($this->nFatura)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE NUM_FATURA = ?";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->nFatura);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return count($result);
			}
		}

		public function exportXls()
		{
			$sql = "SELECT  * FROM controle_faturamento.tb_controle ORDER BY ID_CONTROLE ASC";
			$data = $this->connection->conn->prepare($sql);
			$data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function validateNewRevenue($agreement, $revenueNum)
		{
			$sql = "SELECT CONVENIO, NUM_FATURA FROM controle_faturamento.tb_controle WHERE NUM_FATURA = ? AND CONVENIO = ?";
			$data = $this->connection->conn->prepare($sql);
			$data->bindParam(1, $revenueNum, PDO::PARAM_INT);
			$data->bindParam(2, $agreement, PDO::PARAM_STR);
			$data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function getRevenueById($idRevenue)
		{
			$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE ID_CONTROLE = ?";
			$data = $this->connection->conn->prepare($sql);
			$data->bindParam(1, $idRevenue, PDO::PARAM_INT);
			$data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function revenueFilter($arrayRevenue, $page, $limit)
		{
			foreach($arrayRevenue as $value) {
				
				$this->convenio = array_key_exists("convenioFiltro", $arrayRevenue)  ? $arrayRevenue['convenioFiltro'] : "";
				$this->pago = array_key_exists("pagoFiltro", $arrayRevenue) ? strtoupper($arrayRevenue['pagoFiltro']) : "";
				$this->conciliado = array_key_exists("conciliadoFiltro", $arrayRevenue) ? strtoupper($arrayRevenue['conciliadoFiltro']) : "";
				$this->valorPago = array_key_exists("valorPagoFiltro", $arrayRevenue) ? $arrayRevenue['valorPagoFiltro'] : "";
				$this->dtFechamento = array_key_exists("dtFechaFiltro", $arrayRevenue)  ? $arrayRevenue['dtFechaFiltro'] : "";
				$this->dtPagamento = array_key_exists("dtPagaFiltro", $arrayRevenue) ? $arrayRevenue['dtPagaFiltro'] : "";
				$this->nFatura = array_key_exists("nFaturaFiltro", $arrayRevenue) ? intval($arrayRevenue['nFaturaFiltro']) : "";
			}

			$sql;
			$data;

			if (!empty($this->convenio)) {
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE CONVENIO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->convenio);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->pago)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE PAGO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->pago);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->conciliado)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE CONCILIADO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->conciliado);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->valorPago)){
				//$this->valorPago = strval($this->valorPago);
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE VL_PAGO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->valorPago);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->dtFechamento)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE DT_FECHAMENTO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->dtFechamento);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->dtPagamento)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE DT_PAGAMENTO = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->dtPagamento);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;

			}elseif(!empty($this->nFatura)){
				$sql = "SELECT * FROM controle_faturamento.tb_controle WHERE NUM_FATURA = ? LIMIT $page, $limit";
				$data = $this->connection->conn->prepare($sql);
				$data->bindParam(1, $this->nFatura);
				$data->execute();
				$result = $data->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
		}

		public function deleteRevenue($idRevenue)
		{
			$this->idControle = $idRevenue;
			$sql = "DELETE FROM controle_faturamento.tb_controle WHERE ID_CONTROLE = ?";
			$data = $this->connection->conn->prepare($sql);
			$data->bindParam(1, $this->idControle, PDO::PARAM_INT);
			$data->execute();
		}
		// metodo que pesquisa se o ID foi removido
		public function selectIdRemoved($idRevenue)
		{
			$this->idControle = $idRevenue;	
			$sql = "SELECT ID_CONTROLE FROM controle_faturamento.tb_controle WHERE ID_CONTROLE = ?";
			$data = $this->connection->conn->prepare($sql);
			$data->bindParam(1, $this->idControle, PDO::PARAM_INT);
			$data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			return count($result);
		}
	}