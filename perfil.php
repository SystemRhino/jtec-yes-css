<?php 
session_start();
require'php/conecta.php';
if(!isset($_SESSION['id'])){
    header('location:./login.php');
}
//Consulta Comentarios
$script_comentarios = $conn->prepare("SELECT * FROM tb_comentario ORDER BY id DESC LIMIT 5");
$script_comentarios->execute();

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta User
$id = $_SESSION['id'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id'");
$script_user->execute();
$user = $script_user->fetch(PDO::FETCH_ASSOC);

//Consulta Notícia
$script_noticias = $conn->prepare("SELECT * FROM tb_noticia WHERE id_autor = '$id'");
$script_noticias->execute();

//Consulta Count Notícia
$script_count_noticias = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_noticias->execute();
$count_not = $script_count_noticias->fetch(PDO::FETCH_ASSOC);
$n_de_noticias = $count_not['COUNT(*)'];

//Consulta Count like
$script_count_like = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_like->execute();
$count_like = $script_count_like->fetch(PDO::FETCH_ASSOC);

// Verificação like
if ($count_like['COUNT(*)'] == 0) {
  $like = '0';
}else{
  //Consulta Soma Like
  $script_soma_likes = $conn->prepare("SELECT sum(nr_curtidas) FROM tb_noticia WHERE id_autor='$id'");
  $script_soma_likes->execute();
  $likes = $script_soma_likes->fetch(PDO::FETCH_ASSOC);
  $like = $likes['sum(nr_curtidas)'];
}

//Consulta Count views
$script_count_views = $conn->prepare("SELECT COUNT(*) FROM tb_noticia WHERE id_autor='$id'");
$script_count_views->execute();
$count_views = $script_count_views->fetch(PDO::FETCH_ASSOC);

if ($count_views['COUNT(*)'] == 0) {
  $views = '0';
}else{
  //Consulta Soma Views
  $script_soma_views = $conn->prepare("SELECT sum(views) FROM tb_noticia WHERE id_autor='$id'");
  $script_soma_views->execute();
  $count_views = $script_soma_views->fetch(PDO::FETCH_ASSOC);
  $views = $count_views['sum(views)'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<meta charset="utf-8">
	<title><?php echo $user['nm_user']; ?></title>
</head>
<body>
	<!-- Nav -->
	<?php include('nav.php');?>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span>
	<div id="accordion">
	<!-- Painel do perfil de user -->
<div id="painel-perfil" class="container col-9">
	<div id="img-name">
		<img width="200" height="200" src="img/<?php echo $user['ds_img'];?>">
		<p><?php echo $user['nm_user'];?></p>
	</div>
	<div>
		<div id="banner" class="bg-light">
			<p><?php echo $user['ds_login'];?></p>
			<?php if($user['id_nivel'] == 1){?>
			<b style="color: purple;">Admin</b>
			<?php }?>
		</div>
		<div>
			<div class="mt-2">
				<button>segui</button>
				<button>favs</button>
				<button class="btn" data-bs-toggle="collapse" data-bs-target="#escrever" aria-expanded="false" aria-controls="collapse"><img width="35" src="img/icons8-criar-ordem.gif"></button>
				<button data-bs-toggle="collapse" data-bs-target="#config" class="btn"><img width="35" src="img/icons8-serviços.gif"></button>
				<button data-bs-toggle="collapse" data-bs-target="#estatisticas" class="btn">Estatísticas</button>
		</div>
	</div>
</div>

		<!-- Form cadastro noticias -->
<div class="collapse" data-bs-parent="#accordion" id="escrever">
	<div class="container  shadow p-3 col-7" id="cadastro-noticia">
	<form id="form_noticia" method="post" enctype="multipart/form-data">
		<div class="form-floating col-6">
			<input class="form-control" type="text" id="nm" name="nm_noticia" placeholder="Titulo da Notícia">
			<label for="nm">Título da Notícia</label>
		</div>
		<div class="col-6">
		<select class="form-control" name="id_categoria">
			<option>Escolha a categoria</option>
			<?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) {?>	
			<option value="<?php echo $categoria['id']?>"><?php echo $categoria['nm_categoria']?></option>
			<?php }?>
		</select>
		</div>
		<div class="form-floating col-12">
			<textarea id="ds" class="form-control" name="ds_noticia" placeholder="Descrição"></textarea>
			<label for="ds">Descrição</label>
		</div>
		<div class="img">
			<div>
				<img id="img-1" src="adm/img/img-not.jpg">
				<input class="form-control" type="file" id="img1"  name="img_1">
			</div>
			<div>
				<img id="img-2" src="adm/img/img-not.jpg">
				<input class="form-control" type="file" id="img2" name="img_2">
			</div>
		</div>
		<button type="submit" class="btn btn-primary" id="enviar">Enviar</button>
	</form>
	</div>
</div>

	<!-- Editar dados do user -->
	<span id="w"></span>
<div class="collapse" data-bs-parent="#accordion" id="config">
	<div class="container shadow p-2 col-7 text-center">
	<form id="form_edit_user" method="post" enctype="multipart/form-data">
	<div id="edit-user">
		<div class="col-6">
			<input  class="form-control m-2" name="nm_user" value="<?php echo $user['nm_user'];?>">
		</div>
		<div class="col-8">
			<input  class="form-control m-2" name="ds_login"  value="<?php echo $user['ds_login'];?>">
		</div>
		<div class="col-6 form-floating m-2">
			<input  class="form-control" id="senhaa" value="<?php echo $user['ds_senha'];?>" disabled>
			<label for="senhaa">Senha Antiga:</label>
		</div>
		<div class="col-6 form-floating m-2">
			<input class="form-control" type="password" name="ds_senha" id="senha" placeholder="Senha:">
			<label for="senha">Nova Senha:</label>
		</div>
	</div>
		<input class="form-control m-2 w-50" type="file" name="ds_img">
		<button class="btn btn-outline-primary m-2" type="submit" id="salvar">Salvar</button>
	</form>
	</div>
</div>
<div class="collapse" data-bs-parent="#accordion" id="estatisticas">
	<h2>Estatisticas</h2>
<br>
<div>
  <h4>Número de noticias</h4>
  <p><?php echo $n_de_noticias;?></p>
</div>

<div>
  <h4>Número de avaliações</h4>
  <p><?php echo $like;?></p>
</div>

<div>
  <h4>Número de views</h4>
  <p><?php echo $views;?></p>
</div>
</div>

<!-- Notícias do user -->
<div class="container mt-5">
<h1>Suas Noticias</h1>
<div class="card-group">
	<?php
		// Verificação se tem noticias
		if ($script_noticias->rowCount()>0){
		while ($noticia = $script_noticias->fetch(PDO::FETCH_ASSOC)) {
		//Consulta Autor
		$id_autor = $noticia['id_autor'];
		$script_nome_autor = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
		$script_nome_autor->execute();
		$nome_autor = $script_nome_autor->fetch(PDO::FETCH_ASSOC);
	?>
		<div id="card" class="card">
			<img src="img/<?php echo $noticia['img_1']; ?>">
			<div class="card-body">	
				<p><?php echo $noticia['nm_noticia']."<br>"; ?></p>
				<p>Autor: <?php echo $nome_autor['nm_user']."<br>"; ?></p>
			</div>
			<div class="card-footer">
			<button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $noticia['id'];?>">Editar</button>
			<a class="btn" href="php/delete_noticia.php?id=<?php echo $noticia['id'];?>">Excluir</a>
			</div>
  		</div>

<!-- Modal -->
	<div class="modal fade" id="exampleModal<?php echo $noticia['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<span id="edit"></span>
			<div class="modal-header">
				<span></span>
			    <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $noticia['id']; ?>"><?php echo $noticia['id']; ?></b></h5>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			    <!-- Inputs -->
			    <form id="form_edit_noticia_<?php echo $noticia['id']; ?>" method="post" enctype="multipart/form-data">
				<label>Nome da Notícia</label>
			    <input class="form-control" type="text" name="nm_noticia" placeholder="Titulo" value="<?php echo $noticia['nm_noticia']; ?>">
			    <label>Descricão</label>
				<input class="form-control" type="text" name="ds_noticia" placeholder="Descrição" value="<?php echo $noticia['ds_noticia']; ?>">

				<input style="display: none;" type="text" name="id" placeholder="id" value="<?php echo $noticia['id']; ?>"><br>

				<input type="file" name="ds_img"><br>
				<input type="file" name="ds_img_2"><br>
				<?php 
					//Consulta Select Categoria
					$script_categoria_select = $conn->prepare("SELECT * FROM tb_categoria");
					$script_categoria_select->execute();
					//Consulta User
					$script_user_select = $conn->prepare("SELECT * FROM tb_users");
					$script_user_select->execute();
				?>
				<!-- Select Categoria -->
				<label>Categoria</label>
				<select class="form-control" name="categoria">
				<?php while($categoria_select = $script_categoria_select->fetch(PDO::FETCH_ASSOC)){?>
					<option value="<?php echo $categoria_select['id'];?>"><?php echo $categoria_select['nm_categoria'];?></option>
				<?php }?>
				</select>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			    <button type="submit" class="btn btn-primary" id="edit_noticia_<?php echo $noticia['id']; ?>">Salvar Alterações</button>
			</form>
			</div>
			</div>
		</div>
	</div>
	<!-- Script editar notícia -->
	<span></span>
	<script type="text/javascript">
$(document).ready(function() {
  $('#form_edit_noticia_<?php echo $noticia['id']; ?>').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/edit_noticia.php', // Arquivo PHP para processar os dados
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

<?php }
			}else{
				echo "Sem noticia";
			}
?>
</div>
</div>

		<!-- Script editar user -->
		<script src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#form_edit_user').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'php/edit_user.php', // Arquivo PHP para processar os dados
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

</div>

<!-- FOOTER -->
	<?php include('footer.php');?>
</body>

<script src="./js/jquery-3.6.0.min.js"></script>
		<!-- Script cadastrar notícia -->
		<script>
  		$(document).ready(function() {
  			$('#form_noticia').submit(function(event) {
    		event.preventDefault(); // Impede o envio padrão do formulário
    		var form_data = new FormData(this);

  			$.ajax({
    			url: 'adm/script_noticia.php', // Arquivo PHP para processar os dados
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
		 
		<script>
			const image = document.querySelector("#img-1"),
			input = document.querySelector("#img1");

			input.addEventListener("change", () => {
			image.src = URL.createObjectURL(input.files[0]);
			});

			const image2 = document.querySelector("#img-2"),
			input2 = document.querySelector("#img2");

			input2.addEventListener("change", () => {
			image2.src = URL.createObjectURL(input2.files[0]);
			});
		</script>
</html>
	

