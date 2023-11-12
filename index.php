<?php  
require'php/conecta.php';
session_start();

//Consulta Placar
$script_placar = $conn->prepare("SELECT * FROM tb_placar");
$script_placar->execute();
$placar = $script_placar->fetch(PDO::FETCH_ASSOC);

//Consulta Notícias em Alta
$script_noticias_alta = $conn->prepare("SELECT * FROM tb_noticia  ORDER BY views DESC");
$script_noticias_alta->execute();

//Consulta Notícias Populares
$script_noticias_populares = $conn->prepare("SELECT * FROM tb_noticia  ORDER BY nr_curtidas DESC");
$script_noticias_populares->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario ORDER BY id DESC LIMIT 5");
$script_comentarios->execute();

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

if(isset($_GET['categoria'])){
$id_categoria = $_GET['categoria'];
//Consulta Notícia Filtro Categoria
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_categoria = '$id_categoria'");
$script_noticias->execute();
$text = "Busca por Categoria";

}else{
//Consulta Últimas Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia ORDER BY id DESC LIMIT 5");
$script_noticias->execute();
$text = "Últimas Notícias";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | J-Tec	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
<style type="text/css">
    .desc,h5{
    white-space: nowrap; 
    width: 280px; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
  </style>
<!-- Nav -->
<?php include('nav.php'); ?>

<!-- While categoria -->
  <div class="categ shadow">
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button class="btn btn-outline-primary m-2 shadow" onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>
 </div>

<!-- Carrossel -->
  <div class="container-fluid carrossel mt-3">
        <img id="img-carousel" src="OIP.jpg" class="img-fluid" alt="...">
        <h2>Bem Vindo(a) ao Jornal da Etec!</h2>
    </div>

  <!-- Placar -->
  <?php if($script_placar->rowCount()>0){?>
<div>
<?php echo $placar['nm_time_1']." ".$placar['gols_1'];?> <b>X</b> <?php echo $placar['nm_time_2']." ".$placar['gols_2'];?>
</div>
<?php }?>

  <!-- While Últimas Noticias -->
  <div class="container m-5">
	 <h1><?php echo $text?></h1>
  <div id="overflow-card" class="card-group">
    <?php
      // Verificação se tem noticias
      if ($script_noticias->rowCount()>0){
      while ($noticia = $script_noticias->fetch(PDO::FETCH_ASSOC)) { 
      //Consulta Autor
      $id_autor = $noticia['id_autor'];
      $script_nome_autor = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
      $script_nome_autor->execute();
      $nome_autor = $script_nome_autor->fetch(PDO::FETCH_ASSOC);
    ?>
		<div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia['id'];?>'">
			<img class="img-card" src="img/<?php echo $noticia['img_1']; ?>">	
      <div class="card-body">
			  <h5><?php echo $noticia['nm_noticia'];?></h5>
        <p class="desc"><?php echo $noticia['ds_noticia'];?></p>
      </div>
      <div class="card-footer">
			  <p>Autor: <?php echo $nome_autor['nm_user']; ?></p>
      </div>
  	</div>
    <?php 
        }
      }else{
	       echo "Sem noticia";
      }

      // Verificação se tem filtro
      if(!isset($_GET['categoria'])){ ?>
   </div>

  <!-- Notícias em Alta -->
  <h1>Em Alta</h1>
  <div id="overflow-card" class="card-group">
    <?php while ($noticia_alta = $script_noticias_alta->fetch(PDO::FETCH_ASSOC)) { 
      $id_autor_alta = $noticia_alta['id_autor'];
      $script_nome_autor_alta = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor_alta'");
      $script_nome_autor_alta->execute();
      $nome_autor_alta = $script_nome_autor_alta->fetch(PDO::FETCH_ASSOC);
    ?>
		<div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia_alta['id'];?>'">
			<img class="img-card" src="img/<?php echo $noticia_alta['img_1']; ?>">
      <div class="card-body">	
			  <h5><?php echo $noticia_alta['nm_noticia']; ?></h5>
        <p class="desc"><?php echo $noticia_alta['ds_noticia'];?></p>
      </div>
      <div class="card-footer">
			  <p>Autor: <?php echo $nome_autor_alta['nm_user']; ?></p>
      </div>
  	</div>
    <?php }}?>
  </div>
 
  <!-- Notícias Populares -->
  <h1>Mais Populares</h1>
  <div id="overflow-card" class="card-group">
    <?php while ($noticia_populares = $script_noticias_populares->fetch(PDO::FETCH_ASSOC)) { 
      $id_autor_popular = $noticia_populares['id_autor'];
      $script_nome_autor_popular = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor_popular'");
      $script_nome_autor_popular->execute();
      $nome_autor_popular = $script_nome_autor_popular->fetch(PDO::FETCH_ASSOC);
    ?>
		<div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia_populares['id']?>'">
			<img class="img-card" src="img/<?php echo $noticia_populares['img_1']; ?>">
      <div class="card-body">	
			  <h5><?php echo $noticia_populares['nm_noticia']; ?></h5>
        <p class="desc"><?php echo $noticia_populares['ds_noticia'];?></p>
      </div>
      <div class="card-footer">
			  <p>Autor: <?php echo $nome_autor_popular['nm_user']; ?></p>
      </div>
  	</div>
    <?php }?>
  </div>
</div>
<!-- Previsão do Tempo -->
  <div id="ww_65a86bcfdb929" v='1.3' loc='auto' a='{"t":"ticker","lang":"pt","sl_lpl":1,"ids":[],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>Mais previsões: <a href="https://oneweather.org/el/ioannina/" id="ww_65a86bcfdb929_u" target="_blank">Kαιροσ Ιωάννινα</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_65a86bcfdb929"></script>

<!-- Footer -->
<?php include('footer.php');?>
</body>
</html>
