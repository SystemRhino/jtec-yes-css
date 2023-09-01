<?php 
		require('conecta.php');
        try{
		$stmt = $conn->prepare('INSERT INTO tb_noticia(nm_noticia,ds_noticia,nr_curtidas,data_post,hora_post,id_categoria) VALUES (:nm,:ds,:nr,NOW(),NOW(),:id)');
		$stmt->execute(array(
			':nm' => $_POST['nome'],
			':ds' => $_POST['descricao'],
			':nr' => $_POST['curtida'],
			':id' => $_POST['categoria']
		));
	}catch (Exception $e){
		echo "Error: ".$e->getMessage();
	}
?>