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
<html lang="en">
<head>
		<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
  	<script type="text/javascript" src="css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TAILWIND CSS -->
    <link href="assets/css/tailwind.css" rel="stylesheet">
    <!-- ALPINE JS -->
    <script src="assets/js/alpine.js" defer></script>

    <title>J-Tec | Admin</title>
</head>
<style type="text/css">
    #desc{
    white-space: nowrap; 
    width: 280px; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
  </style>

<body class="antialiased bg-gray-100">
    <div class="flex relative" x-data="{navOpen: false}">
        <!-- NAV -->
        <nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-black transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
            <div class="flex flex-col justify-between h-full">
                <div class="p-4">
                    <!-- LOGO -->
                    <a class="flex items-center text-white space-x-4" href="../">
                        <img src="../img/azul-branco.png" width="50" height="50">
                        <span class="text-2xl font-bold">Admin</span>
                    </a>

                    <!-- SEARCH BAR -->
                    <div class="border-gray-700 py-5 text-white border-b rounded">
                        <div class="relative">
                           
                        </div>
                        <!-- SEARCH RESULT -->
                    </div>

                    <!-- NAV LINKS -->
                    <div class="py-4 text-gray-400 space-y-1">
                        <!-- BASIC LINK -->
                        <a href="#" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Placar</span>
                        </a>
                        <!-- DROPDOWN LINK -->
                        <div class="block" x-data="{open: false}">
                            <div @click="open = !open" class="flex items-center justify-between hover:bg-gray-800 hover:text-white cursor-pointer py-2.5 px-4 rounded">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    <span>Gerenciar</span>
                                </div>
                                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>    
                            </div>
                            <div x-show="open" class="text-sm border-l-2 border-gray-800 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
                                <a href="categoria.php" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Categorias
                                </a>
                                <a href="users.php" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Usuarios
                                </a>
                                <a href="noticia.php" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Noticias
                                </a>
                                <a href="placar.php" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Placar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </nav>
        <!-- END OF NAV -->

        <!-- PAGE CONTENT -->
        <main class="flex-1 h-screen overflow-y-scroll overflow-x-hidden">
            <div class="md:hidden justify-between items-center bg-black text-white flex">
                <h1 class="text-2xl font-bold px-4">J-Tec</h1>
                <button @click="navOpen = !navOpen" class="btn p-4 focus:outline-none hover:bg-gray-800">
                    <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
            <section class="max-w-7xl mx-auto py-4 px-5">
                <div class="flex justify-between items-center border-b border-gray-300">
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Placar</h1>
                </div>

	<!-- Tag "span" usada para retorno do ajax -->
	<span id="span_cadastro"></span><br>

	<!-- Form cadastro noticias -->
	<div class="container">
	<form id="form_noticia" class="form-control" method="post" enctype="multipart/form-data">
		<div class="form-floating col-6">
			<input class="form-control" type="text" id="nm" name="nm_noticia" placeholder="Titulo da Notícia">
			<label for="nm">Título da Notícia</label>
		</div>
		<div class="col-6">
		<select class="form-control" name="id_categoria">
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

	<script src="js/jquery-3.6.0.min.js"></script>
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
			$("#span_cadastro").html(response); // Exibe a resposta do servidor
    
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


                
                <!-- TABLE -->
                <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">#ID</th>
				<th class="py-3 px-6 text-left">Titulo</th>
				<th class="py-3 px-6 text-center">Descrição</th>
				<th class="py-3 px-6 text-center">Imagem 1</th>
				<th class="py-3 px-6 text-center">Imagem 2</th>
                <th class="py-3 px-6 text-center">Data</th>
                <th class="py-3 px-6 text-center">Hora</th>
                <th class="py-3 px-6 text-center">Categoria</th>
                <th class="py-3 px-6 text-center">Autor</th>
                <th class="py-3 px-6 text-center">Views</th>
                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            <?php while ($noticia = $script_noticia->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <?= $noticia['id']?>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span><?= $noticia['nm_noticia']?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div id="desc"><?= $noticia['ds_noticia']?></div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                   <img width="50" height="50" src="../img/<?php echo $noticia['img_1']; ?>">
                                </td>
                                <td class="py-3 px-6 text-center">
                                   <img width="50" height="50" src="../img/<?php echo $noticia['img_2']; ?>"> 
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?= $noticia['data_post']?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?= $noticia['hora_post']?>
                                </td>
<?php
			//Consulta Categoria Where
				$id_categoria = $noticia['id_categoria'];
				$script_categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = '$id_categoria'");
				$script_categoria->execute();
				$categoria = $script_categoria->fetch(PDO::FETCH_ASSOC);
			?>
                <td class="py-3 px-6 text-center">
                      <?= $categoria['nm_categoria']?>
                </td>
			<?php
			//Consulta User
				$id_autor = $noticia['id_autor'];
				$script_user = $conn->prepare("SELECT * FROM tb_users WHERE id = '$id_autor'");
				$script_user->execute();
				$user = $script_user->fetch(PDO::FETCH_ASSOC);
			?>
                                
                                <td class="py-3 px-6 text-center">
                                    <?= $user['nm_user']?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?= $noticia['views']?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                        <div data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $noticia['id']; ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div onclick="window.location.href = 'php/delete_noticia.php?id=<?php echo $noticia['id'];?>'" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
		
			<!-- Modal -->
			<div class="modal fade" id="exampleModal<?php echo $noticia['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<input type="file" name="ds_img"><br>
					<input type="file" name="ds_img_2"><br>

					<input style="display: none;" type="text" name="id" placeholder="id" value="<?php echo $noticia['id']; ?>"><br>

			       <input type="text" name="nm_noticia" placeholder="Titulo" value="<?php echo $noticia['nm_noticia']; ?>"><br>
			       <textarea name="ds_noticia" placeholder="Descrição" >
			       	<?php echo $noticia['ds_noticia']; ?>
			       </textarea>
			       
<br>

<?php 
//Consulta Select Categoria
$script_categoria_select = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria_select->execute();

//Consulta User
$script_user_select = $conn->prepare("SELECT * FROM tb_users");
$script_user_select->execute();
?>

					<!-- Select Categoria -->
					<select name="categoria">
					<?php while($categoria_select = $script_categoria_select->fetch(PDO::FETCH_ASSOC)){?>
					<option value="<?php echo $categoria_select['id'];?>"><?php echo $categoria_select['nm_categoria'];?></option>
					<?php }?>
				   </select>
<br>
				   <!-- Select User -->
				   <select name="autor">
					<?php while($user_select = $script_user_select->fetch(PDO::FETCH_ASSOC)){?>
					<option value="<?php echo $user_select['id'];?>"><?php echo $user_select['nm_user'];?></option>
					<?php }?>
				   </select>
					
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="submit" class="btn btn-primary" name="edit_noticia_<?php echo $noticia['id']; ?>">Salvar Alterações</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#form_edit_noticia_<?php echo $noticia['id']; ?>').submit(function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    var form_data = new FormData(this);

  $.ajax({
    url: 'edit_noticia.php', // Arquivo PHP para processar os dados
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
                        <?php }?>

                        </tbody>
                    </table>
                </div>
                <!-- END OF TABLE -->

                
            </section>
            <!-- END OF PAGE CONTENT -->
        </main>
    </div>
</body>
</html>
