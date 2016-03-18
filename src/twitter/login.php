<?php

/**
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 Application Layout PHP
* @version 1.0
* @package AppLayout PHP 
* @subpackage Social Loginer 
* @link http://www.elbahja.me
*/

if (!defined('SRC_DIR')) exit("direct access not allowed");

if ($LoginType != "twitter"){
	exit("login type not exists");
}elseif ($Config[$LoginType]['consumer_key'] == "" || $Config[$LoginType]['consumer_secret'] =="") {
	exit("consumer key || secret empty. Go To : <a href='https://apps.twitter.com'>apps.twitter.com</a>");
}

error_reporting(0);
require_once(SRC_DIR."twitter/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;

if(isset($_GET['oauth_token']) || $_GET['oauth_verifier'])
{	
	$Twitter_conn = new TwitterOAuth($Config['twitter']['consumer_key'], $Config['twitter']['consumer_secret'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	$access_token = $Twitter_conn->oauth('oauth/access_token', array('oauth_verifier' => $_REQUEST['oauth_verifier'], 'oauth_token'=> $_GET['oauth_token']));

	$Twitter_conn = new TwitterOAuth($Config['twitter']['consumer_key'], $Config['twitter']['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);

	$UserData = $Twitter_conn->get('account/verify_credentials');
	$uname = explode(" ",$UserData->name);
    $data = array();
    $data['oauth'] = "twitter";
	$data['uid'] = $UserData->id;
	$data['name'] = $UserData->name;
	$data['email'] = "";
	$data['gender'] = "";
	$data['last_name'] = isset($uname[1]) ? $uname[1] :'';
	$data['first_name'] = isset($uname[0]) ? $uname[0] :'';
	$data['picture'] = implode(explode("_normal", $UserData->profile_image_url), "_bigger");
    $loginer->user((object)$data);
	$_SESSION['sloginer'] = array("uid" => $data['uid'], "name" => $data['name'], "oauth" => $data['oauth']);
	$return_to = $_SESSION['loginer_redirect']; 
	$oauth_token = $access_token['oauth_token'];
	$oauth_token_secret = $access_token['oauth_token_secret'];
	unset($_SESSION['oauth_token_secret']);
	unset($_SESSION['oauth_token']);
	header("location: ".$Config['return_url']);
	exit();	

} else {
	
$Twitter_conn = new TwitterOAuth($Config['twitter']['consumer_key'], $Config['twitter']['consumer_secret']);
$request_token = $Twitter_conn->oauth("oauth/request_token", array("oauth_callback" => $Config["login_url"]."?oauth=twitter"));
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
$loginUrl = $Twitter_conn->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
header("Location: " . $loginUrl);
exit();
}
