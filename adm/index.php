<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
$dir = basename(__DIR__);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | J-Tec</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
</head>
<body>
<?php include('../nav.php'); ?>
<div class="container-fluid mt-2 shadow p-3">
	<a class="btn btn-outline-primary shadow" href="categoria.php">Categoria</a>
	<a class="btn btn-outline-primary shadow" href="users.php">Users</a>
	<a class="btn btn-outline-primary shadow" href="noticia.php">Noticia</a>
</div>

</body>
</html>