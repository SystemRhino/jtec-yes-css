<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
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

	<div class="container bg-light mt-5">
		<div class="update container">
		<form id="form-up" method="post">
			<div class="group-up">
			<input class="form-control" type="text" name="nm" value="<?php echo ($rows['nm_noticia']);?>">
			<textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" placeholder="<?php echo ($rows['ds_noticia']);?>"></textarea>
			</div>

			<div class="group-up2 container">
			<select class="form-control" name="categoria">
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
			<input class="form-control" type="number" name="curtidas" value="<?php echo ($rows['nr_curtidas']);?>">
			<input type="date" class="form-control" name="data" value="<?php echo ($rows['data_post']);?>">
			<input type="datetime" class="form-control" name="hora" value="<?php echo ($rows['hora_post']);?>">
			<button class="btn btn-light mb-2" type="submit" name="enviar">Enviar</button>
			</div>
			</form>
			</div>
	</div>

	<?php

	if (isset($_POST["enviar"])) {
		//var_dump($id);

		$nome = $_POST['nm'];
		$ds = $_POST['descricao'];
		$nr = $_POST['curtidas'];
		$data = $_POST['data'];
		$hr = $_POST['hora'];
		$categoria = $_POST['categoria'];

		
	$update = "UPDATE tb_noticia SET nm_noticia = :nm, ds_noticia = :ds, nr_curtidas = :nr, data_post = :dt, hora_post = :hr, id_categoria = :idc WHERE id = :id";
	$update = $conn->prepare($update);

	$update->bindParam(':id',$id);
	$update->bindParam(':nm',$nome);
	$update->bindParam(':ds',$ds);
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