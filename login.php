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
	<title>Login | J-tec</title>
	<meta charset="utf-8">
	</head>
<body>
	<?php include('nav.php');?>
	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>
	<div class="container-fluid shadow form col-6 p-4 text-center">
		<h2>Informe seus dados e faça seu login!</h2>
		<div class="form-floating mb-3 mt-3">
			<input class="form-control" type="email" id="login" placeholder="exemplo@gmail.com">
			<label for="login">Digite seu e-mail!</label>
		</div>
		<div class="form-floating mb-3">
			<input class="form-control" type="text" id="password" placeholder="Senha123">
			<label for="password">Sua senha</label>
		</div>
		<button class="btn btn-primary m-3" id="entrar">Entrar</button>
		<h6>Não é usuário? Entre <a href="cadastro.php">aqui!</a></h6>
	</div>
</body>
	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#entrar").click(function(){
  			$.ajax({
  				url: "php/script_login.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&password="+$("#password").val(),
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
</html>