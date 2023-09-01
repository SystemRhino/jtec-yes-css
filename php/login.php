<?php 
	require('conecta.php');
	session_start();
	$login = $_POST['log'];
	$senha = $_POST['pass'];

	$stmt = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login and ds_senha = :senha');
	$stmt->bindValue("login", $login);
	$stmt->bindValue("senha", $senha);
	$stmt->execute();
		if ($stmt->rowCount()>0){
			$dado = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['id'] = $dado['id'];
			$_SESSION['nivel'] = $dado['id_nivel'];

			echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
		}else{
			echo "usuario ou senha incorretos!";
		}
?>