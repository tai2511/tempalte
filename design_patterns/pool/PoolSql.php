<?php

namespace design_patterns\pool;

use file_handle\FileUtil;
use mysqli;

class PoolSql{

	// show status like 'Conn%'; check connection close

	private array $poolStack;
	private int $size = 5;

	/**
	 * The Singleton's instance is stored in a static field. This field is an
	 * array, because we'll allow our Singleton to have subclasses. Each item in
	 * this array will be an instance of a specific Singleton's subclass. You'll
	 * see how this works in a moment.
	 */
	private static $instances = [];

	/**
	 * Singletons should not be cloneable.
	 */
	protected function __clone() { }

	/**
	 * Singletons should not be restorable from strings.
	 */
	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): PoolSql
	{
		$cls = static::class;
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static();
		}

		return self::$instances[$cls];
	}

	private function __construct(){
		$content = FileUtil::readFile2String(FileUtil::getPoolFileName());
		if ($content == '') {
		    $this->poolStack = [];
		} else {
			$this->poolStack = json_decode($content);
		}
	}

	public function getPoolConnection() {
		if (!$this->isEmptyPool()) {
			$con = end($this->poolStack);
			array_pop($this->poolStack);
			return $con->connection;
		}
		return $this->createNewConnectionPool()->createConnection();
	}

	public function addPoolConnection(mysqli $mysqli) {
		if ($this->isFullPool()) {
			$mysqli->close();
		} else {
			$objData = $this->createNewConnectionPool()->setPoolConnection($mysqli);
			echo "<pre>";
			print_r(unserialize(serialize($objData)));
			echo "</pre>";
			die;
			array_push($this->poolStack, unserialize($objData));

			echo "<pre>";
			print_r(unserialize($objData));
			echo "</pre>";
			die;
			FileUtil::writeString2File(FileUtil::getPoolFileName(), $content);
		}
	}

	private function isEmptyPool() {
		return count($this->poolStack) < 1;
	}

	private function isFullPool() {
		return count($this->poolStack) > $this->size;
	}

	private function createNewConnectionPool() {
		return new PoolConnection();
	}

}
