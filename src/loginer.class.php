<?php

/**
* Social Loginer Class
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 Application Layout PHP
* @version   1.0
* @package AppLayout PHP 
* @subpackage Social Loginer
* @link http://www.elbahja.me 
*/

if (!defined('SRC_DIR')) exit("direct access not allowed");

class Loginer {

	protected $loginType, $config, $conn, $table;
	protected $incfile = null;    
	
	function __construct($data) {

		$this->loginType = $data['loginer'];
		$this->config = $data['config'];
		$this->table = $data['db_info']['users_table'];

		if (file_exists(SRC_DIR.$this->loginType."/login.php")) {
			$this->incfile = SRC_DIR.$this->loginType."/login.php"; 
		}

        if (isset($data['db_info'])) {
        	$this->conn = new mysqli($data['db_info']['host'], $data['db_info']['user'], $data['db_info']['pass'], $data['db_info']['db_name']);
	        	if (!$this->conn):
	        		die("Failed connect to MySQL");
	        	elseif(!$this->conn->set_charset('utf8')):
	        		die("Error loading character set utf8");
	        	endif;	
        } else {
           die("db_info empty");
        }

	}

	public function incfile() {
		return $this->incfile;
	}

	public function user($data) {
		$check_user = $this->conn->query("SELECT * FROM $this->table WHERE oauth ='$data->oauth' AND uid ='$data->uid'");
		$now = date("Y-m-d H:i:s", time());
		if ($check_user->num_rows > 0) {
			$up = $this->conn->query("UPDATE $this->table SET name ='$data->name', email ='$data->email', gender ='$data->gender', last_name ='$data->last_name', first_name ='$data->first_name', picture ='$data->picture', date_modified ='$now' WHERE oauth ='$data->oauth' AND uid ='$data->uid'");
		} else {
			$new = $this->conn->query("INSERT INTO $this->table SET oauth ='$data->oauth', uid ='$data->uid', name ='$data->name', email ='$data->email', gender ='$data->gender', last_name ='$data->last_name', first_name ='$data->first_name', picture ='$data->picture', date_created ='$now', date_modified ='$now'");
		}
	}
}
