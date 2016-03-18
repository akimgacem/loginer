<?php

/**
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 Application Layout PHP
* @version 1.0
* @package AppLayout PHP 
* @subpackage Social Loginer 
* @link http://www.elbahja.me
*/

define("SRC_DIR", "src/");

$db_config = array(
		"host" => "localhost",
		"user" => "root",
		"pass" => "",
		"db_name" => "test",
		"users_table" => "loginer_users",
);

$Config = Array(

// Login URL Config
 	"login_url" => "http://localhost-40.com/login.php",	

// Return user		
 	"return_url" => "http://localhost-40.com/example.php",		

// Facebook login config 
 		// go to : developers.facebook.com/
	"facebook" => array(
		"Statut" => 1, 
		"app_id" => "167885977352",
		"app_secret" => "70cdc6459125f3ce8327fe5ece09f",		
		"default_graph_version" => "v2.5",		
	),

// google login config 
		// go to : console.developers.google.com
	"google" => array(
		"Statut" => 1,
		"clientId" => "1093260479743-4s3u00lai3aa420c8t4j3v2qpdri.apps.googleusercontent.com",
		"clientSecret" => "ErEcnUptfXP0FO2-15Xt",
		"ApplicationName" => " Your App Name ",		
	),	

// Twitter Login config 
	// go to : apps.twitter.com
	"twitter" => array(
		"Statut" => 1,
		"consumer_key" => "iZO5Ln9bcIX3F1mXOqIiODN",		
		"consumer_secret" => "9vPPjgkSbf7fV5YxOwD26Z8gn2kAlnrB6ntAAHqsknHTfsR",		
	),	
);