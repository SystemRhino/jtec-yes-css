<?php 
$URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

session_start();
require'php/conecta.php';
$id = $_GET['id'];
if(isset($_SESSION['id'])){
  $id_user = $_SESSION['id'];
  $session = true;
}else{
  $session = false;
}

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id ='$id'");
$script_noticias->execute();
$noticia = $script_noticias->fetch(PDO::FETCH_ASSOC);
$id_categoria = $noticia['id_categoria'];
$id_autor = $noticia['id_autor'];

//Consulta Ultimas Noticias
$script_ultimas_noticias = $conn->prepare("SELECT * FROM tb_noticia");
$script_ultimas_noticias->execute();
$ultima_noticia = $script_ultimas_noticias->fetch(PDO::FETCH_ASSOC);

//Consultar autor
$script_autor = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_autor'");
$script_autor->execute();
$autor = $script_autor->fetch(PDO::FETCH_ASSOC);

if ($session == true){
//Consultar seguindo autor
$script_seguindo_autor = $conn->prepare("SELECT * FROM tb_seguidores WHERE id_autor ='$id_autor' and id_seguidor ='$id_user'");
$script_seguindo_autor->execute();
}

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id ='$id_categoria'");
$script_categoria->execute();
$categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);

//Consulta Notícias da mesma categoria
$script_noticias_categoria = $conn->prepare("SELECT * FROM tb_noticia WHERE id_categoria ='$id_categoria' and id NOT IN ('$id')");
$script_noticias_categoria->execute();

//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario WHERE id_noticia ='$id' ORDER BY id DESC");
$script_comentarios->execute();

//Atualizar Views
$qnt = $noticia['views'] +1;
$att_views = $conn->prepare("UPDATE `tb_noticia` SET `views` = '$qnt' WHERE (`id` = '$id');");
$att_views->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title><?php echo $noticia['nm_noticia']; ?></title>
</head>
<body>
<!-- Nav -->
<?php include('nav.php');?>

<div id="grid-noticia" class="container mx-auto">
<!--NOTÍCIA -->
	<div class="container">
    <div class="header-noticia">
      <h2><?php echo $noticia['nm_noticia']; ?></h2>
	    <img id="img-noticia" src="img/<?php echo $noticia['img_1'];?>">
    </div>
  <div class="container mt-2">
    <p><?php echo $noticia['ds_noticia']; ?></p>
    <hr>
    <div class="d-flex flex-wrap align-items-end">
      <i class="col btn">Data de publicação: <?php echo $noticia['data_post']; ?></i>
      
    </div>
        <button class="btn" id="curtir"><img width="30" src="img/icons8-gosto-disso-50.png"> <?php echo $noticia['nr_curtidas']; ?></button>
        <!-- Compartilhar nas redes sociais -->
        <button class="copyTest col btn" data-bs-toggle="modal" data-bs-target="#modalCompartilhar"><img width="35" src="img/icons8-compartilhar-50.png"></button>
          <!-- Modal -->
          <div class="modal fade" id="modalCompartilhar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <span id="edit"></span>
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Compartilhar nas redes sociais</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn" onclick="window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=<?= $URL_ATUAL?>'"><img width="50" src="img/face.png"></button>
                  <button type="button" class="btn" onclick="window.location.href = 'https://www.linkedin.com/shareArticle?mini=true&url=<?= $URL_ATUAL?>'"><img width="90" src="img/linkedin.png"></button>
                  <button type="button" class="btn" onclick="window.location.href = 'https://api.whatsapp.com/send?text=<?= $URL_ATUAL?>'"><img width="40" src="img/zap.png"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Campo do autor -->
  <div>
    <div id="div-autor" class="container shadow w-50">
		  <img id="autor" src="img/<?php echo $autor['ds_img']; ?>">
	    <div id="autor-seguir">
		    <h5><?php echo $autor['nm_user'];?></h5>
	      <!-- Seguir autor -->
      <?php if($id_autor !== $_SESSION['id']){?>
        <div class="d-flex align-items-end flex-wrap align-content-end">
        <?php if ($session == true){?>
	      <?php if ($script_seguindo_autor->rowCount()>0){ ?>
	        <button class="btn font-btn" id="seguir"><img width="15" src="img/icons8-remover-50.png"> Deixar de seguir</button>
	      <?php }else{ ?>
	        <button class="btn font-btn" id="seguir"><img width="15" src="img/icons8-a-seguir-32.png"> Seguir</button>
	      <?php }} ?>
        </div>
      <?php }else{?>
        <p>Você</p>
      <?php }?>
	    </div>	
    </div>

          <h3>Última postagens</h3>

    <div id="overflow-card" class="card-group">
      <div class="card-view" onclick="window.location.href = 'view.php?id=<?= $ultima_noticia['id']?>'">
          <img id="img-categoria" src="img/<?php echo $ultima_noticia['img_1']; ?>">
          <div class="card-body"> 
            <h5><?php echo $ultima_noticia['nm_noticia']."<br>"; ?></h5>
            <p><?php echo $ultima_noticia['ds_noticia']."<br>"; ?></p>
          </div>
        </div>
    </div>

          <h3>Última postagens</h3>

    <div id="overflow-card" class="card-group">
      <div class="card-view" onclick="window.location.href = 'view.php?id=<?= $ultima_noticia['id']?>'">
          <img id="img-categoria" src="img/<?php echo $ultima_noticia['img_1']; ?>">
          <div class="card-body"> 
            <h5><?php echo $ultima_noticia['nm_noticia']."<br>"; ?></h5>
            <p><?php echo $ultima_noticia['ds_noticia']."<br>"; ?></p>
          </div>
        </div>
    </div>

  </div>
</div>
</div>

	<!-- Noticias da mesma categoria -->
  <div class="container m-5 text-center">
	  <h2>Mais da categoria <?php echo $categoria['nm_categoria']; ?></h2>
	  <div id="overflow-card" class="card-group">
      <?php while ($noticia_categoria = $script_noticias_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
		    <div class="card-view" onclick="window.location.href = 'view.php?id=<?= $noticia_categoria['id']?>'">
			    <img id="img-categoria" src="img/<?php echo $noticia_categoria['img_1']; ?>">
          <div class="card-body">	
			      <h5><?php echo $noticia_categoria['nm_noticia']."<br>"; ?></h5>
            <p><?php echo $noticia_categoria['ds_noticia']."<br>"; ?></p>
          </div>
  		  </div>
      <?php }?>
    </div>
  </div>

<div class="container">
  <?php if ($session == true){?>
	  <!-- Tag "span" usada para retorno do comentario -->
	  <span></span>

	  <!-- Adiconar Comentario -->
    <div class="container mt-2">
	    <textarea class="form-control shadow w-75 p-4 mb-2 bg-white" id="comentario" placeholder="Deixe um comentario"></textarea>
	    <button class="btn btn-outline-success" id="comentar">Comentar</button><br>
      <?php }else{?>
      <p>Faça login para poder comentar!</p>
      <?php }?>
    </div>

	  <!-- While dos comentarios -->
	  <h2>Comentários</h1>
  <?php  
    while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
	    $id_user = $comentario['id_user'];
	    $script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	    $script_users->execute();	
	    $user = $script_users->fetch(PDO::FETCH_ASSOC);
  ?>
  <div id="coment-div" class="mt-2 bg-light w-75">
    <div>
	  <img id="img-autor" src="img/<?php echo $user['ds_img'];?>">
    </div>
    <div class="text-start">
      <h5><?php echo $user['nm_user'];?></h5>
      <p><i><?php echo $comentario['comentario'];?></i></p>
      <div class="text-end" id="data"><p><?php echo $comentario['data'];?></p></div>
    </div>
  </div>
  <?php }?>

</div>

    </body>

<script src="./js/jquery-3.6.0.min.js"></script>
        <script>

// Comentar
$(document).ready(function(){
  $("#comentar").click(function(){
    $.ajax({
    url: "php/script_comentar.php",
    type: "POST",
    data: "comentario="+$("#comentario").val()+"&id_noticia="+<?php echo $id;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});

// Curtir
$(document).ready(function(){
  $("#curtir").click(function(){
    $.ajax({
    url: "php/script_like.php",
    type: "POST",
    data: "id_noticia="+<?php echo $id;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});

// Seguir
$(document).ready(function(){
  $("#seguir").click(function(){
    $.ajax({
    url: "php/script_seguir.php",
    type: "POST",
    data: "id_autor="+<?php echo $id_autor;?>+"&id_user="+<?php echo $id_user;?>,
    dataType: "html"

    }).done(function(resposta) {
        $("span").html(resposta);
        console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);

    }).always(function() {
        console.log("completou");
    });
  });
});


// Função copiar url
function copyTextToClipboard(text) {
  var textArea = document.createElement("textarea");
  textArea.value = text;

  document.body.appendChild(textArea);
  textArea.select();

  try {
    var successful = document.execCommand('copy');
  } catch (err) {
    console.log('Oops, unable to copy');
  }

  document.body.removeChild(textArea);
}

// Teste
var copyTest = document.querySelector('.copyTest');
copyTest.addEventListener('click', function(event) {
  copyTextToClipboard('<?php echo $URL_ATUAL;?>');
});
        </script>
</html>