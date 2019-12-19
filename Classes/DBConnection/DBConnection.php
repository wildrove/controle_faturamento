<?php
namespace Classes\DBConnection;
	use PDO;

	class DBConnection {
		public $conn = null;

		public function __construct()
		{
			$this->createConnection('mysql', 'localhost', 'controle_faturamento', 'wilder', '12345');
		}

		public function createConnection($driverName, $hostName, $dbName, $userName, $pass)
		{
			try{

				$this->conn = new \PDO("$driverName:host=$hostName; dbName=$dbName", $userName, $pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $e){

				echo 'Não foi possível conectar ' . $e->getMessage();
			}
		}
	}