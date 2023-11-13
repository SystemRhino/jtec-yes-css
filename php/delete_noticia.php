<?php
session_start();
		$id = $_GET['id'];
		include('conecta.php');
		try {
		  $delete_noticia = $conn->prepare("DELETE FROM tb_noticia WHERE (`id` = '$id')");
		  $delete_noticia->execute();
		  header('location:../perfil.php');
		} catch(PDOException $e) {
		    echo $e;
		}

?>