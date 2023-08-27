<?php

	session_start();
	include_once("auth.php");

	$cuser = new Auth();

	if(!isset($_SESSION['orgName']))
	{
		header("location: login.php");
	}

	$orgName = $_SESSION['orgName'];

	$orgData = $cuser->currentOrganizationDetails($orgName);

	$orgID = $orgData['org_id'];
	$uname = $orgData['username'];
	$email = $orgData['email'];
	$phone = $orgData['phone'];
	$reg_date = $orgData['reg_date'];
	$business_reg = $orgData['business_reg'];
	$country = $orgData['country'];
	$city = $orgData['city'];
	$province = $orgData['province'];
	$last_login = $orgData['last_login'];
	$status = $orgData['status'];


?>