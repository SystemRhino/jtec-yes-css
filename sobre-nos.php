<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title></title>
</head>
<body>
	<!-- Nav -->
	<?php include('nav.php');?>

	<div class="container mt-5 col-8 div-equipe">
		<div class="text-center p-2">
			<h3>Sobre a Nossa Equipe</h3>
		</div>
		<div class="equipe m-3">
			<div class="col img-equipe">
				<img width="300px" src="img/id-equipe/sem-fundo/logo-vertical-s_fundo.png">
			</div>
			<div class="col">
				A WeBrain, é uma equipe composta por 5 alunos da Etec de Itanhaém, que estão cursando o último ano do Ensino Médio do curso de Informática para a Internet do ETIM,  que possui nome polissêmico, como “Nós Cérebro” e “Cérebro Web”. Temos como missão o planejamento, a concepção e a atualizações de sistemas acessíveis para microempreendedores. Nossa visão é auxiliar o acesso ao mundo tecnológico para empresas e microempreendedores com ampla assistência e segurança. E nossos valores são a responsabilidade, eficiência, modernidade e a qualidade de nossos produtos e no suporte ao cliente.
			</div>
		</div>
	</div>
		<div class="container mt-5">
			<h4 class="text-center">Conheça os Integrantes</h4>
			<div class="card-group group-equipe d-flex align-items-center m-3">
				<div style="background: #4F3559; color: white;" class="card card-equipe text-center">
					<img src="img/id-equipe/ana.jpeg">
					<div class="card-body">
						<h6>Ana Claudia de Souza</h6>
						<p>Programadora / Design</p>
					</div>
				</div>
				<div style="background: #7E1F41; color: white;" class="card card-equipe text-center">
					<img src="img/id-equipe/anna.jpeg">
					<div class="card-body">
						<h6>Anna Luiza Fernandes Magalhães</h6>
						<p>Analista</p>
					</div>
				</div>
				<div style="background: #612048; color: white;" class="card card-equipe text-center">
					<img src="img/id-equipe/davi.jpeg">
					<div class="card-body">
						<h6>Davi José Leal Alves</h6>
						<p>Programador / Banco de Dados</p>
					</div>
				</div>
				<div style="background: #000000; color: white;" class="card card-equipe text-center">
					<img src="img/iuser.png">
					<div class="card-body">
						<h6>Matheus Araújo de Souza</h6>
						<p>Analista</p>
					</div>
				</div>
				<div style="background: #4F3559; color: white;" class="card card-equipe text-center">
					<img src="img/id-equipe/wesley.jpeg">
					<div class="card-body">
						<h6>Wesley Pedro Castaldelli Leandro</h6>
						<p>Banco de Dados / Analista</p>
					</div>
				</div>
			</div>
		</div>
</body>
</html>