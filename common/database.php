<?php
	
	require_once('common/app.php');

	class DB {

		public $conn;
		public $app;
		public $query = [];
		public $QUERY_LOG = FALSE;

		function __construct($hostname,$username,$password,$database)
		{
		    $this->conn = mysqli_connect($hostname,$username,$password,$database) or die('Database is still not setup ...');
		    $this->app = new App();
		    return $this->conn;
		}
		function query($query) {
			if($this->QUERY_LOG)
				$this->query[] = $query;
			$res = mysqli_query($this->conn,$query);
			return $res;
		}
		function get($res,$inArrayOnly = false) {
			$rows = [];
			while($row = mysqli_fetch_assoc($res)) {
				$rows[] = $row;
			}
			if(!$inArrayOnly) {
				$rows= $this->toStdObject($rows);
			}
			return $rows;
		}
		function getOne($res,$inArrayOnly = false) {
			$row = mysqli_fetch_assoc($res);
			if(!$inArrayOnly) {
				$row = $this->toStdObject($row);
			}
			return $row;
		}
		function toStdObject($rows) {
			$rows = json_decode(json_encode($rows));
			return $rows;
		}
		function numRows($res) {
			return mysqli_num_rows($res);
		}
		function getAffectedRows() {
			return mysqli_affected_rows($this->conn);	
		}
		function getLastInsertedId() {
			return mysqli_insert_id($this->conn);	
		}
		function realEscapeRequest($request) {
			foreach ($request as $key => $value) {
				$request[$key] = mysqli_real_escape_string($this->conn,$value);
			}
			return $request;
		}
		function freeResultset($res) {
			mysqli_free_result($res);
		}
		function getCurrentDB() {
			return $this->getOne($this->query("SELECT DATABASE() as DB"))->DB;
		}
		function showDBTables() {
			$db = $this->getCurrentDB();
			$table_alias = "Tables_in_".$db;
			return $this->get($this->query("SHOW TABLES FROM $db"));
		}
		function enableQueryLog($bool = false) {
			$this->QUERY_LOG = $bool;
		}
		function showDBLog() {
			if($this->QUERY_LOG) {
				if(empty($this->query)) {
					dump('No query has been logged.');
				}
				else {
					dump($this->query);
				}
			}
			else {
				dump('Please enable querylog first to log your query log. Use enableQueryLog(true) before log your query.');
			}
		}
	}

?>