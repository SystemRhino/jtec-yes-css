<?php 
session_start();
require'php/conecta.php';
if(!isset($_SESSION['id'])){
    header('location:./login.php');
}
//Consulta User
$script_users = $conn->prepare("SELECT * FROM tb_users");
$script_users->execute();

//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();

//Consulta Notícia
$id = $_SESSION['id'];
$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id ='$id'");
$script_user->execute();
$user = $script_user->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="adm/css/style.css">
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
<?php while ($users = $script_users->fetch(PDO::FETCH_ASSOC)) { ?>
	<!-- Painel do perfil de user -->
<div id="painel-perfil" class="container">
	<div id="img-name">
		<img width="200" height="200" src="img/<?php echo $user['ds_img'];?>">
		<p><?php echo $user['nm_user'];?></p>
	</div>
	<div>
		<div id="banner" class="bg-light">
			<p><?php echo $user['ds_login'];?></p>
			<?php if($user['id_nivel'] = 1){?>
			<b style="color: purple;">Admin</b>
			<?php }?>
		</div>
		<div>
			<div class="mt-2">
				<button>segui</button>
				<button>favs</button>
				<button data-bs-toggle="collapse" data-bs-target="#escrever" aria-expanded="false" aria-controls="collapse">escrever</button>
				<button data-bs-toggle="collapse" data-bs-target="#config<?php echo $users['id']; ?>">config</button>
			</div>
			<div class="d-flex justify-content-end">
				<button>Estatísticas</button>
				<button>Button</button>
			</div>
		</div>
	</div>
</div>

		<!-- Form cadastro noticias -->
<div class="collapse mt-3" data-bs-parent="#accordion" id="escrever">
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
				<img id="img-1" src="adm/img/img-not.jpg">
				<input class="form-control" type="file" id="img1"  name="img_1">
			</div>
			<div>
				<img id="img-2" src="adm/img/img-not.jpg">
				<input class="form-control" type="file" id="img2" name="img_2">
			</div>
		</div>
		<button type="submit" id="enviar">Enviar</button>
	</form>
	</div>
</div>

	<!-- Editar dados do user -->
<div class="collapse mt-3" data-bs-parent="#accordion" id="config<?php echo $users['id']; ?>">
	<div class="container col-8">
 		<span id="edit"></span>
		<h5>Editar User #<b id="id_<?php echo $users['id']; ?>"><?php echo $users['id']; ?></b></h5>
		<input class="form-control" type="text" id="nm_user_<?php echo $users['id']; ?>" placeholder="Nome" value="<?php echo $users['nm_user']; ?>">
		<input class="form-control" type="text" id="ds_login_<?php echo $users['id']; ?>" placeholder="E-mail" value="<?php echo $users['ds_login']; ?>">
		<div id="edit-user">
		<div class="col-6">
			<label>Senha Antiga:</label>
			<input class="form-control" type="password" id="<?php echo $users['id'];?>" placeholder="Senha" value="<?php echo $users['ds_senha']; ?>" disabled>
		</div>
		<div class="col-6">
			<label>Nova Senha:</label>
			<input class="form-control" type="password" id="ds_senha_<?php echo $users['id']; ?>" placeholder="Senha" value="<?php echo $users['ds_senha']; ?>">
		</div>
		</div>
		<select class="form-control" id="id_nivel_<?php echo $users['id']; ?>">
			<option value="<?php echo $users['id_nivel']; ?>">
			<?php if($users['id_nivel'] == 1){ 
					echo "Admin";
				}else{ 
					echo "User";
				} ?>
			</option>
			<option value="2">User</option>
			<option value="1">Admin</option>
		</select>
		<button class="btn btn-danger"
		data-bs-toggle="collapse" data-bs-target="#config<?php echo $users['id']; ?>" aria-controls="collapse">Cancelar</button>
		<button type="button" class="btn btn-primary" id="edit_user_<?php echo $users['id']; ?>">Salvar Alterações</button>
	</div>
	</div>
</div>

		<!-- Script editar user -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#edit_user_<?php echo $users['id']; ?>").click(function(){
  			$.ajax({
  				url: "adm/php/edit_user.php",
  				type: "POST",
  				data: "nm_user="+$("#nm_user_<?php echo $users['id']; ?>").val()+"&ds_login="+<?php echo $users['id'];?>+"&ds_login="+$("#ds_login_<?php echo $users['id']; ?>").val()+"&ds_senha="+$("#ds_senha_<?php echo $users['id']; ?>").val()+"&id_nivel="+$("#id_nivel_<?php echo $users['id']; ?>").val()+"&id="+<?php echo $users['id'];?>,
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

<?php }?>
</div>
</body>

<script src="./js/jquery-3.6.0.min.js"></script>
</html>
	

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