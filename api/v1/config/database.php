<?php
	class Database
	{
		private $host;
		private $database_name;
		private $username;
		private $password;
		public  $conn;
		
		public function __construct()
		{
			$appVariables = json_decode(file_get_contents(__DIR__ . "/../../../env.json"), true);
			$this->host          = $appVariables['DB_HOST'];
			$this->database_name = $appVariables['DB_NAME'];
			$this->username      = $appVariables['DB_USERNAME'];
			$this->password      = $appVariables['DB_PASSWORD'];
		}
		
		public function getConnection()
		{
			$this->conn = null;
			try {
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
				$this->conn->exec("set names utf8");
			} catch (PDOException $exception) {
				echo "Database could not be connected: " . $exception->getMessage();
			}
			return $this->conn;
		}
		
		public function getConnectionStatus()
		{
			$this->conn = null;
			try {
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
				$this->conn->exec("set names utf8");
				return [
					'status' => 'success',
					'message' => "Database connection successfully"
				];
			} catch (PDOException $exception) {
				return [
					'status' => 'error',
					'message' => "Database could not be connected: " . $exception->getMessage()
				];
			}
		}
	}