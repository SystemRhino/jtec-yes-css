<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | J-Tec	</title>
	<link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>      
</head>
<body>

<footer>
  <div>
  <p>Author: Hege Refsnes</p>
  <p><a href="mailto:hege@example.com">hege@example.com</a></p>
  </div>
  
  <!-- While Comentarios -->
  <div>
  <h1>Últimos comentarios</h1>
  <?php  
    while ($comentario = $script_comentarios->fetch(PDO::FETCH_ASSOC)) {
	  $id_user = $comentario['id_user'];
	  $script_users = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id_user'");
	  $script_users->execute();	
	  $user = $script_users->fetch(PDO::FETCH_ASSOC);
	?>
	<b><?php echo $user['nm_user'];?></b><p><i><?php echo $comentario['comentario']?></i></p><p><?php echo $comentario['data'];?></p>
	<hr>
  <?php }?>
  </div>
</footer>

</body>
</html>