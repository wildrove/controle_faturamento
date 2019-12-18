<?php
namespace Classes\Faturamento\ControleFaturamento;

	
	class ControleFaturamento {

		public function __construct()
		{
			echo "Olá Mundo";
		}

		public function __get($atribute)
		{
			return $this->$atribute;
		}

		public function __set($value, $atribute)
		{
			$this->$atribute = $value;
		}
	}