<?php
	require('conecta.php');

 	if (!isset($_GET['pesquisar'])) {
		header("Location: ../index.php");
		exit;
	}
 
	$dados = "%".trim($_GET['pesquisar'])."%";
  
	$sql = $conn->prepare('SELECT * FROM tb_noticia WHERE ds_noticia LIKE :ds');
	$sql->bindParam(':ds', $dados, PDO::PARAM_STR);
	$sql->execute();
 
	$resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

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
	<form method="get" action="pesquisar.php">
			<input type="search" name="pesquisar">
			<button type="submit" name="buscar">P</button>
	</form>

	<?php
		if (count($resultados)) {
			echo "<label class='p-2 mt-3'><small>Resultado da busca:</small></label><hr>";
			foreach($resultados as $Resultado) {
	?>
	<div class="card">
				<div class="card-header"><?php echo $Resultado['nm_noticia'];?></div>
				<div class="card-body"><?php echo $Resultado['ds_noticia']."<br>".$Resultado['data_post']."&emsp;".$Resultado['hora_post'];?></div>
				<div class="card-footer">
					<button onclick="window.location.href = 'delete_noticia.php?tb=tb_noticia&&id=<?php echo $Resultado['id']?>'">Delete</button>
					<button onclick="window.location.href = 'update_noticia.php?tb=tb_noticia&&id=<?php echo $Resultado['id']?>'">Editar</button>
					<button onclick="window.location.href = 'view.php?id=<?= $Resultado['id']?>'">Ver mais</button>
				</div>
	</div>
	<?php
			} 
		} else {
	?>

	<h3>Nenhum resultado encontrado!</h3>

	<?php
		}
	?>
</body>
</html>