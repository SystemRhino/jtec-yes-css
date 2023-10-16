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
  <div class="container">
    <a class="navbar-brand float-none" href="<?php echo $dir?>"><img id="logo" src="img/id-projeto/sem-fundo/azul-branco.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="btn btn-outline-info" href="<?php echo $dir?>">Home</a>       
          <a></a>
        </li>
        <li class="dropdown">
          <button class="btn btn-outline-info dropdown-toggle" type="button"  type="button" data-bs-toggle="dropdown" aria-expanded="false">Cursos</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Administração - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="#">Meio Ambiente - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="#">Informática - ETIM/M-TEC</a></li>
            <li><a class="dropdown-item" href="#">Administração - MODULAR</a></li>
            <li><a class="dropdown-item">Desenvolvimento de Sistemas - MODULAR</a></li>
            <li><a class="dropdown-item">Farmácia - MODULAR</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <!-- Verificação de sessão -->
    <?php if(isset($_SESSION['id'])){?>
      <a class="btn btn-outline-info" href="perfil.php">Perfil</a> |
      </li>
      <li class="nav-item">
    <?php }else{?>
      <a class="btn btn-outline-info" href="login.php">Login</a> |
    <?php }?>
      </li>
      <li class="nav-item">
    <?php if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){?>
      <a class="btn btn-outline-info" href="./adm/">Adm</a> |
    <?php }?>
      </li>
      </ul>
      <form action="search.php" method="GET" class="form-inline d-flex">
        <input class="form-control me-2" type="text" name="data" placeholder="Pesquisar notícia">
        <button class="btn btn-outline-info" type="submit">Pesquisar</button>
      </form>
    </div>
</nav>
</body>
</html>


