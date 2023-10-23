<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categoria | J-Tec</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  <script type="text/javascript" src="css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
</head>
	<!-- CSS -->
	<style>
		table {
			border:1px solid #b3adad;
			border-collapse:collapse;
			padding:5px;
		}
		table th {
			border:1px solid #b3adad;
			padding:5px;
			background: #f0f0f0;
			color: #313030;
		}
		table td {
			border:1px solid #b3adad;
			text-align:center;
			padding:5px;
			background: #ffffff;
			color: #313030;
		}
	</style>

	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar").click(function(){
  			$.ajax({
  				url: "php/script_categoria.php",
  				type: "POST",
  				data: "categoria="+$("#categoria").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("span").html(resposta);

		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  	});
});
	</script>
	</head>
<body>
	<!-- Tag "span" usada para retorno do ajax -->
	<span></span>

<div class="container mt-3 col-6">
	<div class="form-floating">
		<input class="form-control" type="text" id="categoria" placeholder="Nome da categoria">
		<label for="categoria">Nome da categoria</label>
	</div>
<button class="btn btn-primary mt-2" id="cadastrar">Cadastrar</button>


	<!-- Tabela exibindo dados da categoria -->
	<div class="mt-3">
		<table>
			<thead>
			<tr>
				<th>#ID</th>
				<th>Nome da Categoria</th>
			</tr>
			</thead>
			<tbody>
			<?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $categoria['id']; ?></td>
				<td><?php echo $categoria['nm_categoria']; ?></td>
				<td><a class="btn btn-outline-danger" href="php/delete_categoria.php?id=<?php echo $categoria['id'];?>">Excluir</a></td>
				<td><button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $categoria['id']; ?>">Editar</button></td>
			</tr>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#edit_categoria_<?php echo $categoria['id']; ?>").click(function(){
  				$.ajax({
  				url: "php/edit_categoria.php",
  				type: "POST",
  				data: "nm_categoria="+$("#nm_categoria_<?php echo $categoria['id']; ?>").val()+"&id="+<?php echo $categoria['id'];?>,
  				dataType: "html"
  				}).done(function(resposta) {
	    	$("span").html(resposta);

			}).fail(function(jqXHR, textStatus ) {
	    	console.log("Request failed: " + textStatus);

			}).always(function() {
	    	console.log("completou");
			});
  			});
		});
		</script>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal<?php echo $categoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			    <span id="edit"></span>
			    <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria #<b id="id_<?php echo $categoria['id']; ?>"><?php echo $categoria['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			    </div>
			    <div class="modal-body">
			       <input type="text" class="form-control" id="nm_categoria_<?php echo $categoria['id']; ?>" placeholder="Nome da categoria" value="<?php echo $categoria['nm_categoria']; ?>"><br>
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_categoria_<?php echo $categoria['id']; ?>">Salvar Alterações</button>
			    </div>
			</div>
			</div>
		</div>

			<?php }?>
			</tbody>
		</table>
	</div>
</div>

</body>
</html>
