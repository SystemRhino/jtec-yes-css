<?php
	require('conecta.php');
	try{
		$stmt = $conn->prepare('INSERT INTO tb_categoria(nm_categoria) VALUES (:nm)');
		$stmt->execute(array(
			':nm' => $_POST['nome']
		));
		echo "<br>".$stmt->rowCount();

	} catch (Exception $e) {
		echo "<br> Error: ".$e->getMessage();
	}
?>