<?php  
include('php/conecta.php');
session_start();


//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario ORDER BY id DESC");
$script_comentarios->execute();

if (!isset($_GET['data']) or $_GET['data']==="") {
	header("Location: ./");
	exit;
}
 
$data = "%".trim($_GET['data'])."%";
 
$search_nm = $conn->prepare('SELECT * FROM `tb_noticia` WHERE `nm_noticia` LIKE :data');
$search_nm->bindParam(':data', $data, PDO::PARAM_STR);
$search_nm->execute();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | J-Tec	</title>
</head>
<body>
<!-- Nav -->
<?php include('nav.php');?>

<!-- While categoria -->
 <div class="categ shadow">
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button class="btn btn-outline-primary m-2 shadow" onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>
 </div>

<!-- While Noticias -->
  <div class="container col-8 m-5">
<?php  if ($search_nm->rowCount()<1){ ?>
	<h3>Nenhum resultado encontrado da pesquisa '<?php echo $_GET['data'];?>'</h3>
	<hr>
<?php }else{ ?>
	<h3>Resultado da pesquisa '<?php echo $_GET['data'];?>'</h3>
	<hr>
<?php } ?>
<div class="container mx-auto">
 <div id="noticia-search" class="card-group">
	<?php while ($noticia = $search_nm->fetch(PDO::FETCH_ASSOC)) { ?>
		<div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img  class="img-card" src="img/<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
  		</div>
	<?php }?>
</div>
</div>
</div>

<?php include('footer.php')?>
</body>
</html>