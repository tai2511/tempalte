<?php

namespace design_patterns\pool;

use mysqli;

class PoolConnection{
	private $lastTime;
	public mysqli $connection;

	public function createConnection() {
		$connection = new mysqli("localhost", "root", "", "test");
		mysqli_set_charset($connection, 'UTF8');
		if (mysqli_connect_errno()) {
			echo "Connect fail!";
			exit();
		}
		return $connection;
	}

	public function setTime() {
		return date("Y-m-d H:i:s",time());
	}

	public function setPoolConnection(mysqli $mysqli) {
		$this->connection = $mysqli;
		$this->lastTime = $this->setTime();
		return $this;
	}
}