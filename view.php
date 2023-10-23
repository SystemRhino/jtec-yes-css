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
	<p><?php // echo $noticia['ds_noticia']; ?></p>
  <p>Um dia descobrimos que beijar uma pessoa para esquecer outra é bobagem.
Você não só não esquece a outra pessoa como pensa muito mais nela...
Um dia nós percebemos que as mulheres têm instinto "caçador" e fazem qualquer homem sofrer...
Um dia descobrimos que se apaixonar é inevitável...
Um dia percebemos que as melhores provas de amor são as mais simples...
Um dia percebemos que o comum não nos atrai...
Um dia saberemos que ser classificado como "bonzinho" não é bom...
Um dia perceberemos que a pessoa que nunca te liga é a que mais pensa em você...
Um dia percebemos que somos muito importante para alguém, mas não damos valor a isso...
Um dia percebemos como aquele amigo faz falta, mas ai já é tarde demais...
Enfim...
Um dia descobrimos que apesar de viver quase um século esse tempo todo não é suficiente para realizarmos todos os nossos sonhos, para beijarmos todas as bocas que nos atraem, para dizer o que tem de ser dito...
O jeito é: ou nos conformamos com a falta de algumas coisas na nossa vida ou lutamos para realizar todas as nossas loucuras...</p>
  <i><?php echo $noticia['data_post']; ?></i>
	<p><?php echo $noticia['nr_curtidas']; ?></p>
</div>

    <!-- Campo do autor -->
  <div>
    <div id="div-autor" class="container shadow w-75 bg-light">
		  <img id="img-autor" width="20" height="20" src="img/<?php echo $autor['ds_img']; ?>">
	    <div>
		    <b><?php echo $autor['nm_user'];?></b>
	      <!-- Seguir autor -->
        <?php if ($session == true){?>
	      <?php if ($script_seguindo_autor->rowCount()>0){ ?>
	        <button class="btn btn-outline-danger" id="seguir">Deixar de seguir</button>
	      <?php }else{ ?>
	        <button class="btn btn-outline-success" id="seguir">Seguir</button>
	      <?php }} ?>
	    </div>	
    </div>
    <div class="bg-light" style="height: 300px; width: auto; margin-top: 10px;">
          <h3>Últimas postagens</h3>
    </div>
    <div class="bg-light" style="height: 300px; width: auto; margin-top: 10px;">
          <h3>Últimas postagens</h3>
    </div>
    <div class="bg-light" style="height: 300px; width: auto; margin-top: 10px;">
          <h3>Últimas postagens</h3>
    </div>
  </div>
</div>
  <div class="container">
    <div class="row row-cols-2">
      <div class="col">
	      <button id="curtir">Curtir</button><br>
      </div>
      <div class="col">
        <!-- Compartilhar nas redes sociais -->
        <button class="copyTest" data-bs-toggle="modal" data-bs-target="#modalCompartilhar">Compartilhar</button>
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
			            <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=<?= $URL_ATUAL?>'">Facebook</button>
			            <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://www.linkedin.com/shareArticle?mini=true&url=<?= $URL_ATUAL?>'">LinkedIn</button>
			            <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://api.whatsapp.com/send?text=<?= $URL_ATUAL?>'">WhatsApp</button>
			          </div>
			        </div>
			      </div>
			    </div>
        </div>
      </div>
    </div>

	<!-- Noticias da mesma categoria -->
  <div class="container text-center">
	  <h2>Mais da categoria <?php echo $categoria['nm_categoria']; ?></h2>
	  <div class="card-group">
      <?php while ($noticia_categoria = $script_noticias_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
		    <div class="card" onclick="window.location.href = 'view.php?id=<?= $noticia_categoria['id']?>'">
			    <img src="img/<?php echo $noticia_categoria['img_1']; ?>">	
			    <h5><?php echo $noticia_categoria['nm_noticia']."<br>"; ?></h5>
          <p><?php echo $noticia_categoria['ds_noticia']."<br>"; ?></p>
  		  </div>
      <?php }?>
    </div>
  </div>

<div class="container">
  <?php if ($session == true){?>
	  <!-- Tag "span" usada para retorno do comentario -->
	  <span></span><br>

	  <!-- Adiconar Comentario -->
	  <textarea class="form-control shadow w-75 p-4 mb-2 bg-white" id="comentario" placeholder="Deixe um comentario"></textarea>
	  <button class="btn btn-outline-success" id="comentar">Comentar</button><br>
  <?php }else{?>
    <p>Faça login para poder comentar!</p>
  <?php }?>

	  <!-- While dos comentarios -->
	  <h2>Comentários</h1>
  <?php  
    while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
	    $id_user = $comentario['id_user'];
	    $script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	    $script_users->execute();	
	    $user = $script_users->fetch(PDO::FETCH_ASSOC);
  ?>

	  <img id="img-autor" height="50" width="50" src="img/<?php echo $user['ds_img'];?>"><b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario'];?></i></p><p><?php echo $comentario['data'];?></p>
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