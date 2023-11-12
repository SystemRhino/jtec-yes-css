<?php
session_start();
// Validação
if ($_POST['comentario'] === "") {
	$strong = "Seu comentário não pode estar vazio!";
	$text = "Tente Novamente.";
	include('error.php');
}elseif (strlen($_POST['comentario']) > 250) {
	$strong = "Número máximo de caracteres atigindo (250)";
	$text = "Tente Novamente.";
	include('error.php');
}else{
	$datetime = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
	include('conecta.php');
	
	try {
	  $stmt = $conn->prepare('INSERT INTO tb_comentario (id_user, comentario, data, id_noticia) VALUES(:id_user, :comentario, :data, :id_noticia)');
	  $stmt->execute(array(
	    ':id_user' => $_SESSION['id'],
	    ':comentario' => $_POST['comentario'],
	    ':data' => $datetime->format('Y-m-d'),
	    ':id_noticia' => $_POST['id_noticia']
	  ));
	  echo "<meta HTTP-EQUIV='refresh' CONTENT='1'>";
	} catch(PDOException $e) {
	    echo $e;
	}
}

?>