<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
	header('location:../');
}
include('php/conecta.php');

//Consulta User
$script_users = $conn->prepare("SELECT * FROM tb_users");
$script_users->execute();

//Consulta Nivel
$script_nivel = $conn->prepare("SELECT * FROM tb_nivel");
$script_nivel->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TAILWIND CSS -->
    <link href="assets/css/tailwind.css" rel="stylesheet">
    <!-- ALPINE JS -->
    <script src="assets/js/alpine.js" defer></script>

    <title>J-Tec | Admin</title>
</head>
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
                            <span>Usuarios</span>
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
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Usuarios</h1>
                </div>

                	<!-- Tag "span" usada para retorno do ajax -->
	<span id="span"></span>

<div class="container col-6 mt-3">
	<div class="form-floating">
		<input class="form-control" type="text" id="user" placeholder="Nome de usuário">
		<label for="user">Nome de Usuário</label>
	</div>
	<div class="form-floating">
		<input class="form-control" type="text" id="login" placeholder="E-mail">
		<label for="login">E-mail</label>
	</div>
	<div class="form-floating">
		<input class="form-control" type="text" id="password" placeholder="Senha">
		<label for="password">Senha</label>
	</div>
		<select class="form-control" id="id_nivel">
			<option value="1">Admin</option>
			<option value="2">User</option>
		</select>
		<button class="btn btn-primary mt-2" id="cadastrar_user">Cadastrar</button>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar_user").click(function(){
  			$.ajax({
  				url: "php/script_user.php",
  				type: "POST",
  				data: "login="+$("#login").val()+"&password="+$("#password").val()+"&user="+$("#user").val()+"&id_nivel="+$("#id_nivel").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("#span").html(resposta);

		}).fail(function(jqXHR, textStatus ) {
	    console.log("Request failed: " + textStatus);

		}).always(function() {
	    console.log("completou");
		});
  	});
});
	</script>

                
                <!-- TABLE -->
                <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">#ID</th>
                                <th class="py-3 px-6 text-left">User</th>
                                <th class="py-3 px-6 text-center">E-mail</th>
                                <th class="py-3 px-6 text-center">Nivel</th>
                                <th class="py-3 px-6 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            <?php while ($users = $script_users->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <?= $users['id']?>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full" src="../img/<?= $users['ds_img']?>">
                                        </div>
                                        <span><?= $users['nm_user']?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?= $users['ds_login']?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?php 
                                    if($users['id_nivel'] == 1){
                                     $nivel = 'Admin'; 
                                     $color = 'purple';
                                 }else{
                                    $nivel = 'User'; 
                                    $color = 'green'; 
                                }
                                ?></span>
                                    <span class="bg-<?= $color?>-200 text-<?= $color?>-600 py-1 px-3 rounded-full text-xs"><?= $nivel?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                       
                                        <div data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $users['id']; ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div onclick="window.location.href = 'php/delete_user.php?id=<?php echo $users['id'];?>'" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           <script type="text/javascript">
		$(document).ready(function(){
			$("#edit_user_<?php echo $users['id']; ?>").click(function(){
  			$.ajax({
  				url: "php/edit_user.php",
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

<!-- Modal -->
			<div class="modal fade" id="exampleModal<?php echo $users['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			    	<span id="edit"></span>
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar User #<b id="id_<?php echo $users['id']; ?>"><?php echo $users['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			      	<!-- Inputs -->
			       <input class="form-control" type="text" id="nm_user_<?php echo $users['id']; ?>" placeholder="Nome" value="<?php echo $users['nm_user']; ?>">
			       <input class="form-control" type="text" id="ds_login_<?php echo $users['id']; ?>" placeholder="E-mail" value="<?php echo $users['ds_login']; ?>">
			       <input class="form-control" type="text" id="ds_senha_<?php echo $users['id']; ?>" placeholder="Senha" value="<?php echo $users['ds_senha']; ?>">
					
					 
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
					
					
			      </div>
			      <div class="modal-footer">
			        <button class="btn btn-outline-danger" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button class="btn btn-outline-success" type="button" class="btn btn-primary" id="edit_user_<?php echo $users['id']; ?>">Salvar Alterações</button>
			      </div>
			    </div>
			  </div>
			</div>

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