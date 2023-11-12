<?php 
	require('conecta.php');
	session_start();

	$login = $_POST['login'];
	$senha = $_POST['password'];

		if(strlen($login) > 80){
			$strong = "E-mail atingiu o limite máximo de caracteres (80)";
			$text = "Tente Novamente.";
			include('error.php');
		}elseif(strlen($senha) > 20){
			$strong = "Senha atingiu o limite máximo de caracteres (20)";
			$text = "Tente Novamente.";
			include('error.php');
		}else{
	// Consultando login e senha
	$stmt = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login and ds_senha = :senha');
	$stmt->bindValue("login", $login);
	$stmt->bindValue("senha", $senha);
	$stmt->execute();
		// Verificando retorno da consulta
		if ($stmt->rowCount()>0){
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['id'] = $dado['id'];
			$_SESSION['nivel'] = $dado['id_nivel'];
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		}else{
			$strong = "Usuário ou senha incorretos!";
			$text = "Tente Novamente.";
			include('error.php');
		}
}
?>