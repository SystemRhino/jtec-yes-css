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
	<meta charset="utf-8">
	<title><?php echo $curso['nm_curso']; ?></title>
</head>
<body>
	<?php include('nav.php'); ?>
<h1><?php echo $curso['nm_curso']; ?></h1>

<p><?php echo $curso['ds_curso']; ?></p>
</body>
</html>