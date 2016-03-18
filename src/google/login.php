<?php

/**
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 Application Layout PHP
* @version 1.0
* @package AppLayout PHP 
* @subpackage Social Loginer 
* @link http://www.elbahja.me
*/

if (!defined('SRC_DIR')) exit('direct access not allowed');

if ($LoginType != "google"){
	exit("login type not exists");
}elseif ($Config[$LoginType]['clientId'] == "" || $Config[$LoginType]['clientSecret'] =="") {
	exit("clientId || clientSecret empty. Go To : <a href='https://console.developers.google.com'>Google Developer Console</a>");
}

include_once(SRC_DIR."google/Google_Client.php");
include_once(SRC_DIR."google/contrib/Google_Oauth2Service.php");

$Client = new Google_Client();
$Client->setApplicationName($Config['google']['ApplicationName']);
$Client->setClientId($Config['google']['clientId']);
$Client->setClientSecret($Config['google']['clientSecret']);
$Client->setRedirectUri($Config['login_url']."?oauth=google");
$google_oauth = new Google_Oauth2Service($Client);

if(isset($_GET['code'])){
	$Client->authenticate();
	$_SESSION['token'] = $Client->getAccessToken();
	//header('Location: ' . $Config['google']['login_url']);
}

if (isset($_SESSION['token'])) {
	$Client->setAccessToken($_SESSION['token']);
}

if ($Client->getAccessToken()) {

	$UserData = $google_oauth->userinfo->get();
    $data = array();
    $data['oauth'] = "google";
	$data['uid'] = $UserData['id'];
	$data['name'] = $UserData['given_name'] ." ". $UserData['family_name'];
	$data['email'] = $UserData['email'];
	$data['gender'] = $UserData['gender'];
	$data['last_name'] = $UserData['given_name'];
	$data['first_name'] = $UserData['family_name'];
	$data['picture'] =  $UserData['picture'];
    $loginer->user((object)$data);
	$_SESSION['sloginer'] = array("uid" => $data['uid'], "name" => $data['name'], "oauth" => $data['oauth']);
	unset($_SESSION['token']);
	header("location: ".$Config['return_url']);
	exit();

} else {
	$loginUrl = $Client->createAuthUrl();
	header("location: ".$loginUrl);
	exit();	
}