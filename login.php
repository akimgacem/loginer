<?php

/**
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 Application Layout PHP
* @version 1.0
* @package AppLayout PHP 
* @subpackage Social Loginer
* @link http://www.elbahja.me 
*/

session_start();

require_once("loginer_config.php");

if (!defined('SRC_DIR')) exit("src folder required");

define('SER_NAME', "http://".$_SERVER["SERVER_NAME"]);

$LoginType = isset($_GET['oauth']) ? strtolower($_GET['oauth']) : false;

if ($_SERVER['REQUEST_METHOD'] === "GET" && $LoginType != false) {


    if (!isset($_SESSION['sloginer'])) {
		if (in_array($LoginType, array_keys($Config)) == false || @$Config[$LoginType]['Statut'] != 1):
		   exit("Login Type Not allowed or Not exists");
		endif;
    } else { 
          header("location: ".SER_NAME);
          exit;
    }

//$_SESSION['loginer_redirect'] = isset($_GET['redirect']) ? $_GET['redirect'] : SER_NAME;

require_once(SRC_DIR."loginer.class.php");

$loginer = new Loginer([
	"loginer" => $LoginType,
	"config" => $Config[$LoginType],
	"db_info" => $db_config,
]);

if ($loginer->incfile() != null):
	require_once($loginer->incfile());
else:
	exit("Include File Not Exists");
endif;

}else{
	exit("login url is Not valid");
}
?>