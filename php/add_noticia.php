<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#enviar").click(function(){
  			$.ajax({
  				url: "script_noticia.php",
  				type: "POST",
  				data: "nome="+$("#nome").val()+"&descricao="+$("#descricao").val()+"&curtida="+$("#curtida").val()+"&categoria="+$("#categoria").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("p").html(resposta);

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
	<div class="container col-6">
		<input class="form-control" type="text" id="nome">
		<input class="form-control" type="text" id="descricao">
		<input class="form-control" type="number" id="curtida">
		<select class="form-control" id="categoria">
		<option disabled selected>Selecione a categoria</option>
		<?php
		require('conecta.php');
		$listagem = $conn->prepare('SELECT * FROM tb_categoria');
		$listagem->execute();
		while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)) {
		?>
			<option value="<?php echo $lista['id']?>"><?php echo $lista['nm_categoria']?></option>
		<?php
		}
		?>
		</select>
		<button id="enviar" class="btn btn-light">Enviar</button>
		<p></p>
	</div>
</body>
</html>