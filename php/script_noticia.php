<?php 
		require('conecta.php');
        try{
		$stmt = $conn->prepare('INSERT INTO tb_noticia(nm_noticia,ds_noticia,img_1,data_post,hora_post,id_categoria) VALUES (:nm,:ds,:img,NOW(),NOW(),:id)');
		$stmt->execute(array(
			':nm' => $_POST['nome'],
			':ds' => $_POST['descricao'],
			':img' => $_POST['img'],
			':id' => $_POST['categoria']
		));
	}catch (Exception $e){
		echo "Error: ".$e->getMessage();
	}
?>