<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="../js/jquery-3.6.0.min.js"></script>
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
	<div>
		<input type="text" id="nome">
		<input type="text" id="descricao">
		<input type="number" id="curtida">
		<select id="categoria">
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
		<button id="enviar">Enviar</button>
		<p></p>
	</div>
</body>
</html>