<?php
session_start();
include('php/conecta.php');
if(!isset($_GET['id'])){
    header('location:./');
}
$id = $_GET['id'];

//Consulta Curso
$script_cursos = $conn->prepare("SELECT * FROM tb_cursos WHERE id ='$id'");
$script_cursos->execute();
if ($script_cursos->rowCount()<1) {
	header('location:./');
}
$curso = $script_cursos->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title><?php echo $curso['nm_curso']; ?></title>
</head>
<body>

	<?php include('nav.php'); ?>

<div id="grid-noticia" class="container mx-auto">
<!--Curso -->
	<div class="container">
    <div class="header-noticia">
      <h2><?php echo $curso['nm_curso']; ?></h2>
	    <img id="img-noticia" src="img/<?php echo $curso['id'].'.jpg';?>">
    </div>
  <div class="container mt-2">
    <p><?php echo $curso['ds_curso']; ?></p>
    <hr>
    </body>

</html>
<?php include('footer.php');?>