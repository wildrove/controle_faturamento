<?php
namespace Classes\Faturamento\ControleFaturamento;
	
	use Classes\DBConnection\DBConnection;
	
	class ControleFaturamento {

		public $connection = null;
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
				$this->convenio = isset($value['convenio']) ? ucfirst($value['convenio']) : "";
				$this->nFatura = isset($value['nFatura']) ? intval($value['nFatura']) : 0;
				$this->nFaturamento = isset($value['nFaturamento']) ? intval($value['nFaturamento']) : 0;
				$this->dtFechamento = isset($value['dtFechamento']) ? $value['dtFechamento'] : "";
				$this->valor = isset($value['valor']) ? floatval(str_replace(",",".", str_replace(".","",$value['valor']))) : 0;
				$this->dtPossivelPagamento = isset($value['dtPossivelPagamento']) ? $value['dtPossivelPagamento'] : "";
				$this->dtPagamento = isset($value['dtPagamento']) ? $value['dtPagamento'] : "";
				$this->pago = isset($value['pago']) ? strtoupper($value['pago']) : "";
				$this->conciliado = isset($value['conciliado']) ? strtoupper($value['conciliado']) : "";
				$this->valorPago = isset($value['valorPago']) ? floatval(str_replace(",",".", str_replace(".","",$value['valorPago']))) : 0;
				$valorGlosa = isset($value['valorGlosa']) ? floatval(str_replace(",",".", str_replace(".","",$value['valorGlosa']))) : 0;
			}
		}
	}