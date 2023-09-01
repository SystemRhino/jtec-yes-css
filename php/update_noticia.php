<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<title></title>
</head>
<body>
	<?php
		require('conecta.php');
		if (isset($_GET['id'])){
		$id = $_GET['id'];
		$tb = $_GET['tb'];

		$sql = "SELECT * FROM $tb WHERE id = :id";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':id',$id);
		$result = $stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		}
	?>

	<div>
		<form method="post">
			<input type="text" name="nm" value="<?php echo ($rows['nm_noticia']);?>">
			<select name="categoria">
				<?php
				$cd = $rows['id_categoria'];
				$categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = :cd");
		 		$categoria->bindValue(':cd', $cd);
		 		$categoria->execute();
		 		$cate = $categoria->fetch(PDO::FETCH_ASSOC);
				?>
				<option><?php echo $cate['nm_categoria'];?></option>
				<?php
				$listagem = $conn->prepare('SELECT * FROM tb_categoria');
				$listagem->execute();
				while($lista = $listagem->fetch(PDO::FETCH_ASSOC)) {
				?>
				<option value="<?php echo $lista['id']?>"><?php echo $lista['nm_categoria']?></option>
				<?php
				}
				?>
			</select>
			<input type="number" name="curtidas" value="<?php echo ($rows['nr_curtidas']);?>">
			<input type="date" name="data" value="<?php echo ($rows['data_post']);?>">
			<input type="datetime" name="hora" value="<?php echo ($rows['hora_post']);?>">
			<textarea name="descricao" id="exampleFormControlTextarea1" rows="3" placeholder="<?php echo ($rows['ds_noticia']);?>"></textarea>
			<input type="text" name="img1" value="<?php echo ($rows['img_1']);?>">
			<input type="text" name="img2" value="<?php echo ($rows['img_2']);?>">

			<input type="submit" name="enviar">
		</form>
	</div>

	<?php

	if (isset($_POST["enviar"])) {
		//var_dump($id);

		$nome = $_POST['nm'];
		$ds = $_POST['descricao'];
		$img1 = $_POST['img1'];
		$img2 = $_POST['img2'];
		$nr = $_POST['curtidas'];
		$data = $_POST['data'];
		$hr = $_POST['hora'];
		$categoria = $_POST['categoria'];

	$update = "UPDATE tb_noticia SET nm_noticia = :nm, ds_noticia = :ds, img_1 = :img1, img_2 = :img2, nr_curtidas = :nr, data_post = :dt, hora_post = :hr, id_categoria = :idc WHERE id = :id";
	$update = $conn->prepare($update);

	$update->bindParam(':id',$id);
	$update->bindParam(':nm',$nome);
	$update->bindParam(':ds',$ds);
	$update->bindParam(':img1',$img1);
	$update->bindParam(':img2',$img2);	
	$update->bindParam(':nr',$nr);
	$update->bindParam(':dt',$data);
	$update->bindParam(':hr',$hr);
	$update->bindParam(':idc',$categoria);

	$resultup = $update->execute();

	if (!$resultup) {
		var_dump($update->errorInfo());
		exit;
	} else{
		echo $update->rowCount() . "Atualizado com sucesso!";
		header('location:../index.php');
	}
	}
	?>
</body>
</html>