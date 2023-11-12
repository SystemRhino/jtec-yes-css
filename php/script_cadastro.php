<?php 
require('conecta.php');

    $ds_img = $_FILES["ds_img"];
	$ext = substr($ds_img['name'], -4);
    $nomeFinal = time().uniqid().$ext;

if($ext == '.jpg' || $ext == 'jpeg' || $ext == '.png'){	
	// Verificando se os inputs estão vazios
	if ($_POST['login'] === "" or $_POST['password'] === "" or $_POST['user'] === "") {
	$strong = "Preencha todos os campos!";
	$text = "Tente Novamente.";
	include('error.php');
	}else{
		// Armazenando dados em variáveis
		$login = $_POST['login'];
		$senha = $_POST['password'];
		$user = $_POST['user'];

		// Validando E-mail
		$valid_email = strpos( $_POST['login'], '@' );
		$valid_email_ponto = strpos( $_POST['login'], '.' );
		$valid_user_space = strpos( $_POST['user'], ' ' );
		if ($valid_email === false or $valid_email_ponto === false) {
			$strong = "Insira um E-mail válido!";
			$text = "Tente Novamente.";
			include('error.php');
		}elseif(strlen($login) > 80){
			$strong = "E-mail atingiu o limite máximo de caracteres (80)";
			$text = "Tente Novamente.";
			include('error.php');
		}elseif(strlen($user) > 80){
			$strong = "Nome de usuario atingiu o limite máximo de caracteres (80)";
			$text = "Tente Novamente.";
			include('error.php');
		}elseif(strlen($senha) > 20){
			$strong = "Senha atingiu o limite máximo de caracteres (20)";
			$text = "Tente Novamente.";
			include('error.php');
		}elseif($valid_user_space === false){
			// Consultando E-mail
		    $script_email = $conn->prepare('SELECT * FROM tb_users WHERE ds_login = :login');
		    $script_email->bindValue("login", $login);
		    $script_email->execute();

		    // Consultando User
		    $script_user = $conn->prepare('SELECT * FROM tb_users WHERE nm_user = :user');
		    $script_user->bindValue("user", $user);
		    $script_user->execute();

			  // Verificando se o email ou user ja esta em uso
			  if ($script_user->rowCount() > 0) {
			  	 echo "Usuário já cadastrado!";
			  }elseif ($script_email->rowCount() > 0){
			  	 echo "E-mail já cadastrado!";
			  }else{
				try{
				if (move_uploaded_file($ds_img['tmp_name'], '../img/'.$nomeFinal)) {
				 $stmt = $conn->prepare('INSERT INTO tb_users(ds_login, ds_senha, nm_user, ds_img, id_nivel) VALUES (:login, :senha, :user, :ds_img, :id_nivel)');
					$stmt->execute(array(
				 ':login' => $login,
				 ':senha' => $senha,
				 ':user' => $user,
				 ':ds_img' => $nomeFinal,
				 ':id_nivel' => 2
				 ));
				 
				 // Consultando as informações do user
				 $listagem = $conn->prepare("SELECT * FROM tb_users where ds_login = :login");
				 $listagem->bindValue("login", $login);
				 $listagem->execute();
				 $lista = $listagem->fetch(PDO::FETCH_ASSOC);
				 // Armazenando na sessão
				 session_start();
				 $_SESSION['id'] = $lista['id'];
				 $_SESSION['nivel'] = $lista['id_nivel'];
				 echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
				} 
			}catch (PDOException $e) {
					echo 'Error: ' . $e->getMessage();
				}
			}
		}else{
			$strong = "Nome de usário não pode conter espaço!";
			$text = "Tente Novamente.";
			include('error.php');
		}
	}
}else{
	$strong = "Envie somente arquivos JPG, JPEG ou PNG!";
	$text = "Tente Novamente.";
	include('error.php');
}
?>
