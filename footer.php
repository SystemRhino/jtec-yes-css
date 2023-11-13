<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <footer class="mt-3">
    <div class="row etec col-10">
      <a href="sobre-nos.php">
      <div>
      <h4>Sobre J-tec</h4>
      <p>O J-Tec é uma plataforma de notícias e informação online e off-line com uma multitude de páginas e funcionalidades, com o objetivo de se tornar possível informar toda a comunidade escolar num geral além de acabar de vez com a ânsia de alunos sobre o polêmico tema de transparência e comunicação escolar.</p>
      </div>
      <div>
        <h4>E-mail Informativo</h4>
        <p>webrain.etec@gmail.com</p>
      </div>
      </a>
    </div>
    <div class="container coment">
    <!-- While Comentarios -->
    <h1>Últimos comentários</h1>
    <?php  
      while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
      $id_user = $comentario['id_user'];
      $id_comentario = $comentario['id_noticia'];
      $script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
      $script_users->execute(); 
      $user = $script_users->fetch(PDO::FETCH_ASSOC);
    ?>
    <div id="coment-div-footer" class="mt-2 w-75">
    <div onclick="window.location.href = 'view.php?id=<?= $id_comentario;?>'">
	  <img id="img-autor-footer" src="img/<?php echo $user['ds_img'];?>">
    </div>
    <div class="text-start-footer">
      <h6><?php echo $user['nm_user'];?></h6>
      <p><i><?php echo $comentario['comentario'];?></i></p>

      <div id="data"><p><?php echo $comentario['data'];?></p></div>
    </div>
  </div>
  <?php }?>
</div>
  </footer>
</body>
</html>