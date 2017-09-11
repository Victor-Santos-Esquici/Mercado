<?php
	$host = "localhost";
	$database = "mercado";
	$userBanco = "root";
	$senhaBanco = "";

	$conexao = new PDO('mysql:host='.$host.';
						dbname='.$database.';
						charset=utf8',$userBanco,$senhaBanco);
?>