<?php

session_start();

//User Logout
if(isset($_POST['action']) && $_POST['action'] == "userLogout")
{
	unset($_SESSION['orgName']);
	session_destroy();

	echo "logout";
}

//Admin Logout
if(isset($_POST['action']) && $_POST['action'] == "adminLogout")
{
	unset($_SESSION['adminUsername']);
	session_destroy();

	echo "adminLogout";
}

?>