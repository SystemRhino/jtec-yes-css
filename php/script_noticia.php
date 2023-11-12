<?php 
session_start();

		require('conecta.php');
        try{
        	header('location:add_noticia.php');
    $nm = $_POST['nome'];
	$ds = $_POST['descricao'];
	$id = $_POST['categoria'];
	$imagem = $_FILES["imagem"];
	$ext = substr($imagem['name'], -4);
        	if($ext == '.jpg' || $ext == '.jpeg' || $ext == '.png'){
  				if($imagem != NULL) {
    				$nomeFinal = time().uniqid().'.jpeg';
   			 if (move_uploaded_file($imagem['tmp_name'], './img/'.$nomeFinal)) {
		$stmt = $conn->prepare('INSERT INTO tb_noticia(nm_noticia,ds_noticia,img_1,data_post,hora_post,id_categoria,id_user) VALUES (:nm,:ds,:img,NOW(),NOW(),:id,:user)');
		$stmt->execute(array(
			':nm' => $nm,
			':ds' => $ds,
			':img' => $nomeFinal,
			':id' => $id,
			':user' => $_SESSION['id']
		));
		}
  	}else {
			$strong = "Você não realizou o upload de forma satisfatória.";
			$text = "Tente Novamente.";
			include('error.php');
    }
    }
	}catch (Exception $e){
		echo "Error: ".$e->getMessage();
	}
?>