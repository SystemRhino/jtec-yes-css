<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home | J-Tec	</title>
	<link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>    
       
</head>
<body>
<nav>
<div class="btn-group">
  <a class="btn btn-outline-info" href="/J-TEC/">Home</a> |
  <a class="btn btn-outline-info dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" href="cursos.php">Cursos</a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <li><button class="dropdown-item btn btn-outline-info" href="#">Administração - ETIM/M-TEC</button></li>
      <li><button class="dropdown-item btn btn-outline-info" href="#">Meio Ambiente - ETIM/M-TEC</button></li>
      <li><button class="dropdown-item btn btn-outline-info" href="#">Informática - ETIM/M-TEC</button></li>
      <li><button class="dropdown-item btn btn-outline-info" href="#">Administração - MODULAR</button></li>
      <li><button class="dropdown-item btn btn-outline-info" href="#">Desenvolvimento de Sistemas - MODULAR</button></li>
      <li><button class="dropdown-item btn btn-outline-info" href="#">Farmácia - MODULAR</button></li>
    </ul> |

  <!-- Verificação de sessão -->
  <?php if(isset($_SESSION['id'])){?>
    <a class="btn btn-outline-info" href="perfil.php">Perfil</a> |
  <?php }else{?>
    <a class="btn btn-outline-info" href="login.php">Login</a> |
  <?php }?>
</div>

  <!-- Pesquisar -->
  <form action="search.php" method="GET">
  <div class="col-6">
	<input class="form-control" type="text" name="data" placeholder="Pesquise uma noticia">
	<button class="btn btn-outline-info" type="submit">Pesquisar</button>
  </div>
</form>


</nav>
</body>
</html>