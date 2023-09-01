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
  				url: "script_categoria.php",
  				type: "POST",
  				data: "nome="+$("#nome").val(),
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
		<button id="enviar">Enviar</button>
	</div>
	<p></p>
</body>
</html>