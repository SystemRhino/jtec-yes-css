<?php  
require'conecta.php';
$id = $_GET['id'];

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id ='$id'");
$script_noticias->execute();
$noticia = $script_noticias->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>View Notícia</title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-lg bg-dark mb-3">
		a
	</nav>
	<div class="container">
	<img height="430" width="690" src="<?php echo $noticia['img_1'];?>"><br>
	<h2><?php echo $noticia['nm_noticia']; ?></h2><br>
	<p><?php echo $noticia['ds_noticia']; ?></p>
	<p><?php echo $noticia['data_post'];?> | <?php echo $noticia['hora_post']; ?></p>
	<button class="btn btn-light" onclick="history.go(-1);">Voltar</button>
	</div>
</body>
</html>