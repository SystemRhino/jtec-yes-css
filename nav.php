<?php 
$dir = '/'.basename(__DIR__).'/';
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
</head>

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div id="icon-jtec"><a href="<?php echo $dir?>"><img id="logo" src="img/azul-branco.png"></a></div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="btn custom-btn btn-5" href="<?php echo $dir?>">Home</a>       
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle btn custom-btn btn-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">Cursos</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cursos.php?id=1">Administração - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="cursos.php?id=2">Meio Ambiente - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="cursos.php?id=3">Informática - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="cursos.php?id=4">Administração - MODULAR</a></li>
            <li><a class="dropdown-item" href="cursos.php?id=5">Desenvolvimento de Sistemas - MODULAR</a></li>
            <li><a class="dropdown-item" href="cursos.php?id=6">Farmácia - MODULAR</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <!-- Verificação de sessão -->
    <?php if(isset($_SESSION['id'])){?>
      <a class="btn custom-btn btn-5" href="perfil.php">Perfil</a> |
      </li>
      <li class="nav-item">
        <a class="btn custom-btn btn-5" href="php/logout.php">Sair</a> 
      </li>
      <li class="nav-item">
    <?php }else{?>
      <a class="btn custom-btn btn-5" href="login.php">Login</a> |
    <?php }?>
      </li>
      <li class="nav-item">
    <?php if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){?>
      <a class="btn custom-btn btn-5" href="./adm/">Gerenciar</a> |
    <?php }?>
      </li>
      </ul>
      <form action="search.php" method="GET" class="form-inline d-flex">
        <input class="form-control me-2 input-search" type="text" name="data" placeholder="Pesquisar notícia">
        <button class="btn" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="45" height="45" viewBox="0 0 128 128" style="fill:#FFFFFF;">
          <path d="M 52.349609 14.400391 C 42.624609 14.400391 32.9 18.1 25.5 25.5 C 10.7 40.3 10.7 64.399219 25.5 79.199219 C 32.9 86.599219 42.600391 90.300781 52.400391 90.300781 C 62.200391 90.300781 71.900781 86.599219 79.300781 79.199219 C 94.000781 64.399219 93.999219 40.3 79.199219 25.5 C 71.799219 18.1 62.074609 14.400391 52.349609 14.400391 z M 52.300781 20.300781 C 60.500781 20.300781 68.700391 23.399219 74.900391 29.699219 C 87.400391 42.199219 87.4 62.5 75 75 C 62.5 87.5 42.199219 87.5 29.699219 75 C 17.199219 62.5 17.199219 42.199219 29.699219 29.699219 C 35.899219 23.499219 44.100781 20.300781 52.300781 20.300781 z M 52.300781 26.300781 C 45.400781 26.300781 38.9 29 34 34 C 29.3 38.7 26.700391 44.800391 26.400391 51.400391 C 26.300391 53.100391 27.600781 54.4 29.300781 54.5 L 29.400391 54.5 C 31.000391 54.5 32.300391 53.199609 32.400391 51.599609 C 32.600391 46.499609 34.699219 41.799219 38.199219 38.199219 C 41.999219 34.399219 47.000781 32.300781 52.300781 32.300781 C 54.000781 32.300781 55.300781 31.000781 55.300781 29.300781 C 55.300781 27.600781 54.000781 26.300781 52.300781 26.300781 z M 35 64 A 3 3 0 0 0 32 67 A 3 3 0 0 0 35 70 A 3 3 0 0 0 38 67 A 3 3 0 0 0 35 64 z M 83.363281 80.5 C 82.600781 80.5 81.850781 80.800391 81.300781 81.400391 C 80.100781 82.600391 80.100781 84.499609 81.300781 85.599609 L 83.800781 88.099609 C 83.200781 89.299609 82.900391 90.6 82.900391 92 C 82.900391 94.4 83.8 96.700391 85.5 98.400391 L 98.300781 111 C 100.10078 112.8 102.39922 113.69922 104.69922 113.69922 C 106.99922 113.69922 109.29961 112.79961 111.09961 111.09961 C 114.59961 107.59961 114.59961 101.90039 111.09961 98.400391 L 98.300781 85.599609 C 96.600781 83.899609 94.300391 83 91.900391 83 C 90.500391 83 89.2 83.300391 88 83.900391 L 85.5 81.400391 C 84.9 80.800391 84.125781 80.5 83.363281 80.5 z M 91.900391 88.900391 C 92.700391 88.900391 93.5 89.200781 94 89.800781 L 106.69922 102.5 C 107.89922 103.7 107.89922 105.59922 106.69922 106.69922 C 105.49922 107.89922 103.6 107.89922 102.5 106.69922 L 89.800781 94.099609 C 89.200781 93.499609 88.900391 92.700391 88.900391 91.900391 C 88.900391 91.100391 89.200781 90.300781 89.800781 89.800781 C 90.400781 89.200781 91.100391 88.900391 91.900391 88.900391 z"></path>
        </svg>
      </button>
      </form>
</nav>
</body>
</html>


