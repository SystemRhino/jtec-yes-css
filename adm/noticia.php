<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Nivel
$script_noticia = $conn->prepare("SELECT * FROM tb_noticia");
$script_noticia->execute();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Categoria | J-Tec</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  	<script type="text/javascript" src="css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
<body>

	<!-- Tag "span" usada para retorno do ajax -->
	<span></span><br>

	<!-- Form cadastro noticias -->
	<div class="container">
	<form id="form_noticia" class="form-control" method="post" enctype="multipart/form-data">
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
				<img id="img-1" src="img/img-not.jpg">
				<input class="form-control" type="file" id="img1"  name="img_1">
			</div>
			<div>
				<img id="img-2" src="img/img-not.jpg">
				<input class="form-control" type="file" id="img2" name="img_2">
			</div>
		</div>
		<button type="submit" id="enviar">Enviar</button>
	</form>
	</div>
</body>

	<!-- Tabela exibindo dados da categoria -->
	<div class="container mt-3">
	<div class="row mx-auto">
	<table>
		<thead>
			<tr>
				<th>#ID</th>
				<th>Titulo</th>
				<th>Descrição</th>
				<th>Imagem 1</th>
				<th>Imagem 2</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th>Views</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($noticia = $script_noticia->fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?php echo $noticia['id']; ?></td>
				<td><?php echo $noticia['nm_noticia']; ?></td>
				<td><?php echo $noticia['ds_noticia']; ?></td>
				<td><img width="50" height="50" src="../img/<?php echo $noticia['img_1']; ?>"></td>
				<td><img width="50" height="50" src="../img/<?php echo $noticia['img_2']; ?>"></td>
                <td><?php echo $noticia['data_post']; ?></td>
                <td><?php echo $noticia['hora_post']; ?></td>
			<?php
			//Consulta Categoria Where
				$id_categoria = $noticia['id_categoria'];
				$script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = '$id_categoria'");
				$script_categoria->execute();
				$categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
			?>
                <td><?php echo $categoria['nm_categoria']; ?></td>
			<?php
			//Consulta User
				$id_autor = $noticia['id_autor'];
				$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
				$script_user->execute();
				$user = $script_user->fetch(PDO::FETCH_ASSOC);
			?>
                <td><?php echo $user['nm_user']; ?></td>
                <td><?php echo $noticia['views']; ?></td>

				<td><a href="php/delete_noticia.php?id=<?php echo $noticia['id'];?>">Excluir</a></td>
				<td><button  data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $noticia['id']; ?>">Editar</button></td>
			</tr>

		<script type="text/javascript">
			$(document).ready(function(){
			$("#edit_user_<?php echo $noticia['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_user.php",
  				type: "POST",
  				data: "nm_user="+$("#nm_user_<?php echo $noticia['id']; ?>").val()+"&ds_login="+<?php echo $noticia['id'];?>+"&ds_login="+$("#ds_login_<?php echo $noticia['id']; ?>").val()+"&ds_senha="+$("#ds_senha_<?php echo $noticia['id']; ?>").val()+"&id_nivel="+$("#id_nivel_<?php echo $noticia['id']; ?>").val()+"&id="+<?php echo $noticia['id'];?>,
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
			<div class="modal fade" id="exampleModal<?php echo $noticia['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $noticia['id']; ?>"><?php echo $noticia['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<!-- Inputs -->
			       <input type="text" id="nm_user_<?php echo $noticia['id']; ?>" placeholder="Nome" value="<?php echo $noticia['nm_user']; ?>"><br>
			       <input type="text" id="ds_login_<?php echo $noticia['id']; ?>" placeholder="E-mail" value="<?php echo $noticia['ds_login']; ?>"><br>
			       <input type="text" id="ds_senha_<?php echo $noticia['id']; ?>" placeholder="Senha" value="<?php echo $noticia['ds_senha']; ?>"><br>
					
					 
			       <select id="id_nivel_<?php echo $noticia['id']; ?>">
				   <option value="<?php echo $noticia['id_nivel']; ?>">
				   <?php if($noticia['id_nivel'] == 1){ 
						echo "Admin";
					 }else{ 
						echo "User";
					 } ?>
					</option>
			       	<option value="2">User</option>
					   <option value="1">Admin</option>
			       </select>
					
					
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_user_<?php echo $noticia['id']; ?>">Salvar Alterações</button>
			      </div>
			    </div>
			  </div>
			</div>

			<?php }?>
		</tbody>
	</table>
	</div>
	</div>

		<script>
  			$(document).ready(function() {
  			$('#form_noticia').submit(function(event) {
    		event.preventDefault(); // Impede o envio padrão do formulário
    		var form_data = new FormData(this);

  			$.ajax({
    			url: 'script_noticia.php', // Arquivo PHP para processar os dados
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
		<!-- Exibir a img para visualizá-la -->
		<script>
			const image = document.querySelector("#img-1"),
			input = document.querySelector("#img1");

			input.addEventListener("change", () => {
			image.src = URL.createObjectURL(input.files[0]);
			});
		</script>
		<script>
			const image2 = document.querySelector("#img-2"),
			input2 = document.querySelector("#img2");

			input2.addEventListener("change", () => {
			image2.src = URL.createObjectURL(input2.files[0]);
			});
		</script>

</body>
</html>
