<?php  
include('php/conecta.php');
session_start();

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
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Nav -->
<?php include('nav.php');?>

<!-- While categoria -->
<?php  while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
	<button onclick="window.location.href = 'index.php?categoria=<?= $categoria['id']?>'"><?php echo $categoria['nm_categoria']; ?></button>
<?php } ?>
<hr>

<!-- Carrossel -->
<div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="OIP.jpg" class="img-fluid" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="OIP.jpg" class="img-fluid" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="OIP.jpg" class="img-fluid" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>

<!-- While Últimas Noticias -->
	<h1><?php echo $text?></h1>
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
		<div onclick="window.location.href = 'view.php?id=<?= $noticia['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia['img_1']; ?>">	
			<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor['nm_user']."<br>"; ?></p>
  		</div>
<?php 
}
}else{
	echo "Sem noticia";
}

// Verificação se tem filtro
if(!isset($_GET['categoria'])){ ?>
<hr>

<!-- Notícias em Alta -->
<h1>Em Alta</h1>
<?php while ($noticia_alta = $script_noticias_alta->fetch(PDO::FETCH_ASSOC)) { 
$id_autor_alta = $noticia_alta['id_autor'];
$script_nome_autor_alta = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
$script_nome_autor_alta->execute();
$nome_autor_alta = $script_nome_autor_alta->fetch(PDO::FETCH_ASSOC);
?>

	<div class="card-group">
		<div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia_alta['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_alta['img_1']; ?>">	
			<p><?php echo $noticia_alta['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor_alta['nm_user']."<br>"; ?></p>
  		</div>
	</div>

<?php }}?>

<!-- Notícias Populares -->
<h1>Mais Populares</h1>
<?php while ($noticia_populares = $script_noticias_populares->fetch(PDO::FETCH_ASSOC)) { 
$id_autor_alta = $noticia_populares['id_autor'];
$script_nome_autor_popular = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
$script_nome_autor_popular->execute();
$nome_autor_popular = $script_nome_autor_popular->fetch(PDO::FETCH_ASSOC);
?>
		<div onclick="window.location.href = 'view.php?id=<?= $noticia_populares['id']?>'">
			<img width="150" height="150" src="img/<?php echo $noticia_populares['img_1']; ?>">	
			<p><?php echo $noticia_populares['nm_noticia']."<br>"; ?></p>
			<p>Autor: <?php echo $nome_autor_popular['nm_user']."<br>"; ?></p>
  		</div>
<?php }?>

<!-- Footer -->
<?php include('footer.php');?>
</body>
</html>