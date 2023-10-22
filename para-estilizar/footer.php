<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <footer class="container">
    <div class="row">
      <div class="col-6">
      <h4>Sobre J-tec</h4>
      <p>Wrap a pair of elements in .form-floating to enable floating labels with Bootstrap’s textual form fields. A placeholder is required on each as our method of CSS-only floating labels uses the :placeholder-shown pseudo-element. Also note that the must come first so we can utilize a sibling selector (e.g., ~).</p>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
    <!-- While Comentarios -->
    <h1>Últimos comentarios</h1>
    <?php  
      while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
      $id_user = $comentario['id_user'];
      $script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
      $script_users->execute(); 
      $user = $script_users->fetch(PDO::FETCH_ASSOC);
    ?>
    <b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
    <?php }?>
      </div>
      </div>
    </div>
  </footer>
</body>
</html>