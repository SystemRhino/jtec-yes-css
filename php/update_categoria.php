
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

		$sql = "SELECT tb_categoria FROM $tb WHERE id = :id";
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
			<input class="form-control" type="text" name="nm" value="<?php echo ($rows['nm_categoria']);?>">
			<button class="btn btn-light mb-2" type="submit" name="enviar">Enviar</button>
			</div>
			</form>
			</div>
	</div>

	<?php

	if (isset($_POST["enviar"])) {
		//var_dump($id);

		$nome = $_POST['nm'];

		
	$update = "UPDATE tb_categoria SET nm_categoria = :nm WHERE id = :id";
	$update = $conn->prepare($update);

	$update->bindParam(':id',$id);
	$update->bindParam(':nm',$nome);

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
</body>
</html>