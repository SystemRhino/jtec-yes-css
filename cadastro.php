<?php
session_start();
// Verificação da sessão
if (isset($_SESSION['id'])) {
  	header('location:index.php');
  } 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro | J-tec</title>
	<meta charset="utf-8">
</head>
	<script src="js/jquery-3.6.0.min.js"></script>
<body>
	<?php include('nav.php');?>
	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

	<div class="container form shadow col-8 p-4 text-center">
		<h2>Informe seus dados e faça seu cadastro!</h2>
		<form id="form_cadastro" method="post" enctype="multipart/form-data">
			<div class="dados p-3">	
		<div class="form-floating mb-3">
			<input class="form-control" type="text" name="user" id="user" placeholder="Ex.: Maria Andrade">
			<label for="user">Digite seu Nome:</label>
		</div>
		<div class="form-floating mb-3">
			<input class="form-control" type="text" name="login" id="login" placeholder="exemplo@gmail.com">
			<label for="login">Digite seu e-mail:</label>
		</div>
		<div class="form-floating">
			<input class="form-control" type="text" name="password" id="password" placeholder="Senha123">
			<label for="password">Digite sua senha:</label>
		</div>
			</div>
		<div class="p-3 col-8">
			<div>
			<img id="img-1" src="img/user.png">
			<input type="file" class="form-control" id="img1" name="ds_img">
			</div>
		</div>
		<div>
			<button class="btn btn-primary" type="submit" id="cadastrar">Cadastrar</button>
			<h6>Se já possui login, entre <a href="login.php">aqui!</a></h6>
		</div>
		</form>
	</div>

</body>
  	<!-- Exibir a img para visualizá-la -->
		<script>
			const image = document.querySelector("#img-1"),
			input = document.querySelector("#img1");

			input.addEventListener("change", () => {
			image.src = URL.createObjectURL(input.files[0]);
			});
		</script>

	<script type="text/javascript">
	$(document).ready(function() {
  	$('#form_cadastro').submit(function(event) {
    	event.preventDefault(); // Impede o envio padrão do formulário
    	var form_data = new FormData(this);

  	$.ajax({
    	url: 'php/script_cadastro.php', // Arquivo PHP para processar os dados
    	type: 'POST',
    	data: form_data, 
    	contentType: false,
    	processData: false,
    	success: function(response) {
			$("span").html(response); // Exibe a resposta do servidor
    
      	},
    	error: function(xhr, status, error) {
    	console.log(xhr.responseText);

      	}
    	});
  	});
	});
	</script>
</html>