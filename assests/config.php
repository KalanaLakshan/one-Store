<?php

	class Database{

		private $dsn = "mysql:host=localhost;dbname=one_store";
		private $dbname = "root";
		private $dbpass = "";

		public $connection;

		public function __construct()
		{
			try{
				$this->connection = new PDO($this->dsn,$this->dbname,$this->dbpass);
			}

			catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}

		
		public function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);

			return $data;
		}


		}

?>