<?php

declare(strict_types=1);

class MySql
{
	private ?string $dbUser       = null;
	private ?string $dbPass       = null;
	private ?string $dbName       = null;
	private ?string $dbHost       = null;
	private mixed   $dbConnection = null;
	private ?string $errorString  = null;
	private bool    $filter       = true;
	public  bool    $newCon       = false;
	public  ?string $query        = null;
	public  mixed   $lastId       = null;
	public static mixed $instance   = null;
	public static mixed $connection = null;

	public function __construct()
	{
		$this->dbConnection = null;
		$this->filter       = true;
		$this->newCon       = false;
	}
		
	public function setNew(): void
	{
		$this->newCon = true;
	}

	public function noFilter(): void
	{
		$this->filter = false;
	}

	/*
	 * Returns a live, shared MySQLi connection.
	 * Credentials are read from config.php (single source of truth).
	 * Re-uses an existing connection instead of opening a new one each call.
	 */
	private function getConnection(): \mysqli
	{
		if ($this->dbConnection !== null) {
			return $this->dbConnection;
		}

		require_once(CONST_BASEDIR . '/config.php');

		$this->dbUser = $config['databaseUser'];
		$this->dbPass = $config['databasePass'];
		$this->dbName = $config['databaseName'];
		$this->dbHost = $config['databaseHost'];

		$conn = @mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);

		if (!$conn) {
			$this->setError('Connection failed: ' . mysqli_connect_error());
			throw new \RuntimeException('Database connection failed: ' . mysqli_connect_error());
		}

		mysqli_set_charset($conn, 'utf8mb4');
		$this->dbConnection = $conn;
		return $this->dbConnection;
	}
		/*
		 * Setting Error Message on Db Operation
		 * Input String Message
		 * Called upon db operation
		*/
		
	public function setError(string $string): void
	{
		$this->errorString = $string;
	}
		
		/*
		 * get Error Message after a db operation
		 * Retrieves the current error Status
		*/
		
	public function getError(): ?string
	{
		return $this->errorString;
	}
		
		/*
		 * Connect to mysqli Database using set up data
		 * Set up data being hold on Constructor
		 * Modify the constrct params for connection change
		*/
		
	/*
	 * Connect to mysqli Database (legacy method kept for backward compatibility)
	 */
	public function connect(): bool
	{
		try {
			$this->getConnection();
			return true;
		} catch (\RuntimeException $e) {
			return false;
		}
	}
		
	public function getInstance(): mixed
	{
		return $this->dbConnection;
	}
		
		
		/*  * Close the mysqli Connection		 
		 */
		
	public function close(): void
	{
		if ($this->dbConnection) {
			mysqli_close($this->dbConnection);
		}
		$this->dbConnection = null;
	}
		
		/*
		 * get ALl results for an SQL Select Statement
		 * Retrieves the result set values in 2 dimensional array
		 * Parms : query String
		 * Returns Array
		*/
		
	public function fetchAll(string $query): array
	{
		$this->query = $query;
		$resultSet   = array();

		$conn   = $this->getConnection();
		$result = mysqli_query($conn, $query);

		if ($result) {
			$fieldsLength = mysqli_num_fields($result);
			$fields       = array();
			$i            = 0;
			while ($property = mysqli_fetch_field($result)) {
				$fields[$i] = $property->name;
				$i++;
			}

			if (mysqli_num_rows($result) > 0) {
				$start = 0;
				while ($row = mysqli_fetch_row($result)) {
					for ($j = 0; $j < $fieldsLength; $j++) {
						if ($this->filter) {
							$resultSet[$start][$fields[$j]] = $this->removeFilter($row[$j]);
						} else {
							$resultSet[$start][$fields[$j]] = $row[$j];
						}
					}
					$start++;
				}
			}
			mysqli_free_result($result);
		} else {
			$this->setError(mysqli_error($conn));
		}

		return $resultSet;
	}
		
		/*
		 * mysqli Insert operations
		 * Paramms $fild->value pair , table name
		*/
		
	public function insert(array $options, string $table): void
	{
		$p           = count($options);
		$start       = 0;
		$fieldString = '';
		$valueString = '';

		foreach ($options as $key => $val) {
			$fieldString .= " `{$key}`";
			$valueString .= " '{$val}' ";
			if ($start < $p - 1) {
				$fieldString .= ',';
				$valueString .= ',';
			}
			$start++;
		}

		$queryString = "INSERT INTO `{$table}` ({$fieldString}) VALUES ({$valueString})";
		$conn        = $this->getConnection();
		$result      = mysqli_query($conn, $queryString);
		if (!$result) {
			$this->setError('Insert: ' . mysqli_error($conn));
		}
	}
		
		
	public function insertMulti(array $fields, array $values, string $table): void
	{
		$p           = count($fields);
		$start       = 0;
		$fieldString = '';
		$valueString = '';

		foreach ($fields as $val) {
			$fieldString .= " `{$val}`";
			if ($start < $p - 1) {
				$fieldString .= ',';
			}
			$start++;
		}

		for ($i = 0; $i < count($values); $i++) {
			$p     = count($values[$i]);
			$start = 0;
			$valueString .= '(';
			foreach ($values[$i] as $val) {
				$valueString .= "'{$val}'";
				if ($start < $p - 1) {
					$valueString .= ',';
				}
				$start++;
			}
			$valueString .= ')';
			if ($i < count($values) - 1) {
				$valueString .= ',';
			}
		}

		unset($fields);
		unset($values);

		$queryString = "INSERT INTO `{$table}` ({$fieldString}) VALUES {$valueString}";
		$conn        = $this->getConnection();
		$result      = mysqli_query($conn, $queryString);
		if (!$result) {
			$this->setError('InsertMulti: ' . mysqli_error($conn));
		}
	}
		
		
		/*
		 * mysqli Update
		 * Params - field->value pair,table name,update condition
		*/
		
	public function update(array $options, string $table, string $condition): void
	{
		$fieldString = '';
		$p           = count($options);
		$start       = 0;

		foreach ($options as $key => $val) {
			$fieldString .= " `{$key}`='{$val}'";
			if ($start < $p - 1) {
				$fieldString .= ',';
			}
			$start++;
		}

		$queryString = "UPDATE `{$table}` SET {$fieldString}";
		if (!empty($condition)) {
			$queryString .= " WHERE {$condition}";
		}
		$this->query = $queryString;

		$conn   = $this->getConnection();
		$result = mysqli_query($conn, $queryString);
		if (!$result) {
			$this->setError(mysqli_error($conn));
		}
	}
		
		/*
		 * mysqli Delete Operation
		 * Params - table name , condition
		*/
		
	public function delete(string $table, string $condition): void
	{
		$queryString = "DELETE FROM `{$table}`";
		if (!empty($condition)) {
			$queryString .= " WHERE {$condition}";
		}

		$conn   = $this->getConnection();
		$result = mysqli_query($conn, $queryString);
		if (!$result) {
			$this->setError(mysqli_error($conn));
		}
	}
		
	public function execute(string $query): void
	{
		$conn   = $this->getConnection();
		$result = mysqli_query($conn, $query);
		if (!$result) {
			$this->setError(mysqli_error($conn));
		}
	}
		/*
		 * Returns last insert ID		 
		*/
		
	/*
	 * BUG FIX: original called mysqli_insert_id() with no arguments — that is invalid.
	 * Must pass the active connection object.
	 */
	public function lastInsertId(): int
	{
		return (int) mysqli_insert_id($this->getConnection());
	}

	public function affectedRows(): int
	{
		return (int) mysqli_affected_rows($this->getConnection());
	}
		
		/*
		 * Filter with Slash on special chars
		*/
		
	public function addFilter(string $string): string
	{
		return addslashes($string);
	}

	/*
	 * Remove added special chars on String
	 */
	public function removeFilter(?string $string): string
	{
		return stripslashes((string) $string);
	}

	public function escapeHtml(string $text): string
	{
		return strip_tags($text);
	}
		
		
	}


?>