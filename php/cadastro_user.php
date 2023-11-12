<?php 
	require('conecta.php');

	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$nm = $_POST['nm'];
	$imagem = $_FILES["imagem"];
	$ext = substr($imagem['name'], -4);

    $stmt = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login');
    $stmt->bindValue("login", $login);
    $stmt->execute();

  if ($stmt->rowCount() > 0) {
  	$strong =  "Erro ao se cadastrar!";
  	$text = "Usuário já cadastrado!";
    include('error.php');
  }else{

  if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){
  if($imagem != NULL) {
    $nomeFinal = time().uniqid().'.jpeg';
    if (move_uploaded_file($imagem['tmp_name'], './img/'.$nomeFinal)) {
     	$stmt = $conn->prepare('INSERT INTO tb_users(ds_login, ds_senha, nm_user, ds_img) VALUES (:login, :senha, :nm, :img)');
			$stmt->execute(array(
				':login' => $login,
				':senha' => $senha,
				':nm' => $nm,
				':img' => $nomeFinal,
		));

		$listagem = $conn->prepare("SELECT * FROM tb_users where ds_login = :login");
		$listagem->bindValue("login", $login);
		$listagem->execute();
		$lista = $listagem->fetch(PDO::FETCH_ASSOC);
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['id'] = $lista['id'];
		header('location:perfil.php');
			}
  	}else {
  		$strong = "Você não realizou o upload de forma satisfatória.";
		$text = "Tente Novamente.";
		include('error.php');
  	}
		}else{
  		$strong = "'Envie somente arquivos JPG, JPEG ou PNG!";
		$text = "Tente Novamente.";
		include('error.php');
				}
		}
?>