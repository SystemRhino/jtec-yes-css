<?php  
session_start();
if ($_SESSION['nivel'] != 1) {
    header('location:../');
}
$dir = basename(__DIR__);
include('php/conecta.php');

//Consulta User
$script_users = $conn->prepare("SELECT * FROM tb_users");
$script_users->execute();

//Consulta Nivel
$script_nivel = $conn->prepare("SELECT * FROM tb_nivel");
$script_nivel->execute();

//Consulta Count Notícia
$script_count_noticias = $conn->prepare("SELECT COUNT(*) FROM tb_noticia");
$script_count_noticias->execute();
$count_not = $script_count_noticias->fetch(PDO::FETCH_ASSOC);
$n_de_noticias = $count_not['COUNT(*)'];

//Consulta Count like
$script_count_like = $conn->prepare("SELECT COUNT(*) FROM tb_noticia");
$script_count_like->execute();
$count_like = $script_count_like->fetch(PDO::FETCH_ASSOC);

//Consulta Count users
$script_count_users = $conn->prepare("SELECT COUNT(*) FROM tb_users");
$script_count_users->execute();
$count_user = $script_count_users->fetch(PDO::FETCH_ASSOC);


if ($count_like['COUNT(*)'] == 0) {
  $like = '0';
}else{
  //Consulta Soma Like
  $script_soma_likes = $conn->prepare("SELECT sum(nr_curtidas) FROM tb_noticia");
  $script_soma_likes->execute();
  $likes = $script_soma_likes->fetch(PDO::FETCH_ASSOC);
  $like = $likes['sum(nr_curtidas)'];
}

//Consulta Count views
$script_count_views = $conn->prepare("SELECT COUNT(*) FROM tb_noticia");
$script_count_views->execute();
$count_views = $script_count_views->fetch(PDO::FETCH_ASSOC);

if ($count_views['COUNT(*)'] == 0) {
  $views = '0';
}else{
  //Consulta Soma Views
  $script_soma_views = $conn->prepare("SELECT sum(views) FROM tb_noticia");
  $script_soma_views->execute();
  $count_views = $script_soma_views->fetch(PDO::FETCH_ASSOC);
  $views = $count_views['sum(views)'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <form action="" method="GET">
                                <input type="search" class="w-full py-2 rounded pl-10 bg-gray-800 border-none focus:outline-none focus:ring-0" placeholder="Search">
                            </form>
                        </div>
                        <!-- SEARCH RESULT -->
                    </div>

                    <!-- NAV LINKS -->
                    <div class="py-4 text-gray-400 space-y-1">
                        <!-- BASIC LINK -->
                        <a href="#" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Geral</span>
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
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Geral</h1>
                </div>

                <!-- STATISTICS -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">


                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Usuarios</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold"><?= $count_user['COUNT(*)']?></h1>
                                <p class="text-xs bg-green-50 text-green-500 px-1 rounded">+7.4</p>
                            </div>
                        </div>
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>                    
                    </div>

                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Visualizações</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold"><?= $views;?></h1>
                                <p class="text-xs bg-red-50 text-red-500 px-1 rounded">-2.9</p>
                            </div>
                        </div>
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
                <!-- END OF STATISTICS -->
                
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
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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