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
</head>
<body>
	<div>
	<img height="450" width="700" src="<?php echo $noticia['img_1'];?>"><br>
	<h2><?php echo $noticia['nm_noticia']; ?></h2><br>
	<p><?php echo $noticia['ds_noticia']; ?></p>
	<p><?php echo $noticia['data_post'];?> | <?php echo $noticia['hora_post']; ?></p>
	<button onclick="history.go(-1);">Voltar</button>
	</div>
</body>
</html>