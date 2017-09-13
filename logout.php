<?php
	session_start();

	if (!isset($_SESSION['usuarioID'])) 
	{
		header("Location: index.php");
	}
	else if (isset($_SESSION['usarioID']) != "") 
	{
		header("Location: index.php");
	}

	if (isset($_GET['logout'])) 
	{
		unset($_SESSION['usuarioID']);
		unset($_SESSION['usuarioLogin']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit();
	}
?>