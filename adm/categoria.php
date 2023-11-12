

<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
    header('location:../');
}
$dir = basename(__DIR__);
include('php/conecta.php');
//Consulta Categoria
$script_categoria = $conn->prepare("SELECT * FROM tb_categoria");
$script_categoria->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                        <!-- SEARCH RESULT -->
                    </div>

                    <!-- NAV LINKS -->
                    <div class="py-4 text-gray-400 space-y-1">
                        <!-- BASIC LINK -->
                        <a href="#" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Categorias</span>
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
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Categorias</h1>
                </div>

                	<!-- JS -->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cadastrar").click(function(){
  			$.ajax({
  				url: "php/script_categoria.php",
  				type: "POST",
  				data: "categoria="+$("#categoria").val(),
  				dataType: "html"
  			}).done(function(resposta) {
	    $("#span_cadastro").html(resposta);

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
	<!-- Tag "span" usada para retorno do ajax -->
	<span id="span_cadastro"></span>

<div class="container mt-3 col-6">
	<div class="form-floating">
		<input class="form-control" type="text" id="categoria" placeholder="Nome da categoria">
		<label for="categoria">Nome da categoria</label>
	</div>
<button class="btn btn-primary mt-2" id="cadastrar">Cadastrar</button>
                
                <!-- TABLE -->
                <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">#ID</th>
                                <th class="py-3 px-6 text-left">Categoria</th>
                                <th class="py-3 px-6 text-left">Acções</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            <?php while ($categoria = $script_categoria->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <?= $categoria['id']?>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                        </div>
                                        <span><?= $categoria['nm_categoria']?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $categoria['id']; ?>" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div  onclick="window.location.href = 'php/delete_categoria.php?id=<?php echo $categoria['id'];?>'" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#edit_categoria_<?php echo $categoria['id']; ?>").click(function(){
  				$.ajax({
  				url: "php/edit_categoria.php",
  				type: "POST",
  				data: "nm_categoria="+$("#nm_categoria_<?php echo $categoria['id']; ?>").val()+"&id="+<?php echo $categoria['id'];?>,
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
		<div class="modal fade" id="exampleModal<?php echo $categoria['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			    <span id="edit"></span>
			    <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria #<b id="id_<?php echo $categoria['id']; ?>"><?php echo $categoria['id']; ?></b></h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			    </div>
			    <div class="modal-body">
			       <input type="text" class="form-control" id="nm_categoria_<?php echo $categoria['id']; ?>" placeholder="Nome da categoria" value="<?php echo $categoria['nm_categoria']; ?>"><br>
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="edit_categoria_<?php echo $categoria['id']; ?>">Salvar Alterações</button>
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