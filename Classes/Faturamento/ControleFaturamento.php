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
				$this->nFaturamento = isset($revenue['nFaturamento']) ? intval($revenue['nFaturamento']) : "-";
				$this->dtFechamento = isset($revenue['dtFechamento']) ? $revenue['dtFechamento'] : "00-00-0000";
				$this->valor = isset($revenue['valor']) ? floatval(str_replace(",",".", str_replace(".","",$revenue['valor']))) : 0;
				$this->dtPossivelPagamento = isset($revenue['dtPossivelPagamento']) ? $revenue['dtPossivelPagamento'] : "00-00-0000";
				$this->dtPagamento = isset($revenue['dtPagamento']) ? $revenue['dtPagamento'] : "00-00-0000";
				$this->pago = isset($revenue['pago']) ? strtoupper($revenue['pago']) : "Não informado";
				$this->conciliado = isset($revenue['conciliado']) ? strtoupper($revenue['conciliado']) : "Não informado";
				$this->valorPago = isset($revenue['valorPago']) ? floatval(str_replace(",",".", str_replace(".","",$revenue['valorPago']))) : 0;
				$this->valorGlosa = isset($revenue['valorGlosa']) ? floatval(str_replace(",",".", str_replace(".","",$revenue['valorGlosa']))) : 0;
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
			$data->bindParam(':nFaturamento', $this->nFaturamento, PDO::PARAM_INT);
			$data->bindParam(':dtFechamento', $this->dtFechamento, PDO::PARAM_STR);
			$data->bindParam(':valor', $this->valor);
			$data->bindParam(':dtPossivelPagamento', $this->dtPossivelPagamento, PDO::PARAM_STR);
			$data->bindParam(':dtPagamento', $this->dtPagamento, PDO::PARAM_STR);
			$data->bindParam(':pago', $this->pago, PDO::PARAM_STR);
			$data->bindParam(':conciliado', $this->conciliado, PDO::PARAM_STR);
			$data->bindParam(':valorPago', $this->valorPago);
			$data->bindParam(':valorGlosa', $this->valorGlosa);
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

		public function revenueFilter($arrayRevenue)
		{

		}
	}