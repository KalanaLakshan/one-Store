<?php

	session_start();

	include_once("auth.php");

	$cadmin = new Auth();

	if(!isset($_SESSION['adminUsername']))
	{
		header("location: login.php");
	}

	$adminName = $_SESSION['adminUsername'];

?>