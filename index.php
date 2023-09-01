<?php 
session_start();
if (isset($_SESSION['login'])) {
		header("location:php/perfil.php");
	}
	else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery-3.6.0.min.js"></script>
	<title></title>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#enviar").click(function(){
  			$.ajax({
  				url: "php/cadastro_user.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&senha="+$("#senha").val()+"&nm="+$("#nm").val()+"&img="+$("#img"),
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#entrar").click(function(){
  			$.ajax({
  				url: "php/login.php",
  				type: "POST",
  				data: "log="+$("#log").val()+"&pass="+$("#pass").val(),
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
		<nav class="navbar navbar-lg bg-dark">
	<div class="btn-group p-3">
		<button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#Modal">Login</button>
		<button class="btn btn-light" onclick="window.location.href = 'php/add_noticia.php'">Cadastrar Notícia</button>
		<button class="btn btn-light" onclick="window.location.href = 'php/add_categoria.php'">Cadastrar Categoria</button>
		<button class="btn btn-light" onclick="window.location.href = 'php/perfil.php'">Perfil</button>
			</div>
		<form method="get" action="php/pesquisar.php">
			<input class="form-control" type="search" name="pesquisar">
			<button class="btn btn-light" type="submit" name="buscar">P</button>
		</form>
			</nav>

	<!-- INÍCIO MODAL DE LOGIN -->
	<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h1 class="modal-title" id="exampleModalLabel">Acesse sua conta!</h1>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      				</div>
      					<div class="modal-body">
      						Faça seu login:<br>
        					<input type="text" class="form-control" id="log">
        					Senha:<br>
        					<input type="text" class="form-control" id="pass">
        					<span></span>
      					</div>
      				<div class="modal-footer">
      					<button type="text" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  						Clique aqui para se cadastrar caso não possua um login!
						</button>
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        				<button type="button" class="btn btn-warning" id="entrar">Entrar</button>
      				</div>
    			</div>
  			</div>
		</div>
		<!-- FIM MODAL DE LOGIN -->

		<!-- INÍCIO MODAL DE CADASTRO -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h1 class="modal-title" id="exampleModalLabel">Faça seu cadastro!</h1>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      				</div>
      					<div class="modal-body">
      						Crie um Login:<br>
        					<input type="text" class="form-control" id="login">
        					Senha:<br>
        					<input type="text" class="form-control" id="senha">
        					Seu nome:<br>
        					<input type="text" class="form-control" id="nm">
        					Imagem:<br>
        					<input type="text" class="form-control" id="img">
        					<span></span>
      					</div>
      				<div class="modal-footer">
      					<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Modal">
  						Faça seu login
						</button>
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        				<button type="button" class="btn btn-warning" id="enviar">Cadastrar</button>
      				</div>
    			</div>
  			</div>
		</div>
		<!-- FIM MODAL DE CADASTRO -->

		<div class="card-group">
			<?php 
			require('php/conecta.php');
			$exibicao = $conn->prepare('SELECT * FROM tb_noticia');
			$exibicao->execute();
			while ($exibir = $exibicao->fetch(PDO::FETCH_ASSOC)) {
		?>
			<div class="card">
				<div class="card-header"><?php echo $exibir['nm_noticia'];?></div>
				<div class="card-body"><?php echo $exibir['ds_noticia']."<br>".$exibir['data_post']."&emsp;".$exibir['hora_post'];?></div>
				<div class="card-footer">
					<button onclick="window.location.href = 'php/delete_noticia.php?tb=tb_noticia&&id=<?php echo $exibir['id']?>'">Delete</button>
					<button onclick="window.location.href = 'php/update_noticia.php?tb=tb_noticia&&id=<?php echo $exibir['id']?>'">Editar</button>
					<button onclick="window.location.href = 'php/view.php?id=<?= $exibir['id']?>'">Ver mais</button>
				</div>
			</div>

		<?php
			}
		?>
		</div>

		<p></p>
</body>
</html>
<?php 
	}
?>