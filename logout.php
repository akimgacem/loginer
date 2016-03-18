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
include("loginer_config.php");
unset($_SESSION['sloginer']);
session_destroy();
header("Location: " . $Config['return_url']);
exit;
?>