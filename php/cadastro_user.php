<?php 
	require('conecta.php');

	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$nm = $_POST['nm'];
	$img = $_POST['img'];

    $stmt = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login');
    $stmt->bindValue("login", $login);
    $stmt->execute();

  if ($stmt->rowCount() > 0) {
  	$strong =  "Erro ao se cadastrar!";
  	$text = "Usuário já cadastrado!";
    include('erro.php');
  }else{

	$stmt = $conn->prepare('INSERT INTO tb_users(ds_login, ds_senha, nm_user, ds_img) VALUES (:login, :senha, :nm, :img)');
	$stmt->execute(array(
			':login' => $login,
			':senha' => $senha,
			':nm' => $nm,
			':img' => $img,
		));

		$listagem = $conn->prepare("SELECT * FROM tb_users where ds_login = :login");
		$listagem->bindValue("login", $login);
		$listagem->execute();
		$lista = $listagem->fetch(PDO::FETCH_ASSOC);
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['id'] = $lista['id'];
		echo "ok";
	}
?>