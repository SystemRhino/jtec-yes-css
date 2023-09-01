<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src="../js/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-5.2.2-dist/css/bootstrap.min.css">
	<script type="text/javascript" src="../css/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<div>
		<?php 
		try{
			require("conecta.php");
			$exibicao = $conn->prepare('SELECT * FROM tb_users where id = :id');
			$exibicao->bindValue("id",$_SESSION['id']);
			$exibicao->execute();
			while ($exibir = $exibicao->fetch(PDO::FETCH_ASSOC)) {
			?>

			<?php
			if ($_SESSION['nivel'] === 1) {
			?>

			<button type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">Usuários</button>
			<div class="collapse" id="collapse">
				<div>
					<table>
						<tr>
							<th>Nome</th>
							<th>Ds_login</th>
							<th>Ds_img</th>
						</tr>
						<?php
							$listagem = $conn->prepare('SELECT * FROM tb_users');
							$listagem->execute();
							while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)) {
						?>
						<tr>
							<td><?php echo $lista['nm_user']?></td>
							<td><?php echo $lista['ds_login']?></td>
							<td><?php echo $lista['ds_img']?></td>
						</tr>
						<?php
							}
						?>
					</table>

				</div>
			</div>
			<button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-not" aria-expanded="false" aria-controls="collapse">Notícias</button>
			<div class="collapse" id="collapse-not">
				<div>
					<table>
						<tr>
							<th>Título</th>
							<th>Descricao</th>
							<th>Img 1</th>
							<th>Img 2 </th>
							<th>N° Curtidas</th>
							<th>Data</th>
							<th>Hora</th>
							<th>Categoria</th>
						</tr>
						<?php
							$noticia = $conn->prepare('SELECT * FROM tb_noticia');
							$noticia->execute();
							while ($not = $noticia->fetch(PDO::FETCH_ASSOC)){
						?>
						<tr>
							<td><?php echo $not['nm_noticia']?></td>
							<td><?php echo $not['ds_noticia']?></td>
							<td><?php echo $not['img_1']?></td>
							<td><?php echo $not['img_2']?></td>
							<td><?php echo $not['nr_curtidas']?></td>
							<td><?php echo $not['data_post']?></td>
							<td><?php echo $not['hora_post']?></td>
						<?php
							$id = $not['id_categoria'];
							$categoria = $conn->prepare("SELECT * FROM tb_categoria WHERE id = :id");
		 					$categoria->bindValue(':id', $id);
		 					$categoria->execute();
		 					$cate = $categoria->fetch(PDO::FETCH_ASSOC);
						?>
							<td><?php echo $cate['nm_categoria']?></td>
						</tr>
						<?php	
							}
						?>
					</table>
				</div>
			</div>

			<button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-cat" aria-expanded="false" aria-controls="collapse">Categorias</button>
			<div class="collapse" id="collapse-cat">
				<div>
					<table>
						<tr>
							<th>Nome</th>
						</tr>
						<?php
							$listagem = $conn->prepare('SELECT * FROM tb_categoria');
							$listagem->execute();
							while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)) {
						?>
						<tr>
							<td><?php echo $lista['nm_categoria']?></td>
						</tr>
						<?php
							}
						?>
					</table>
				</div>
			</div>

			<?php
			}else{

			}
			
			?>

		<p><?php echo $exibir['nm_user'];?></p>
		<p><?php echo $exibir['ds_login'];?></p>
		<p><?php echo $exibir['ds_senha'];?></p>
		<p><?php echo $exibir['ds_img'];?></p>
		<?php
		}
			}catch(PDOExcepition $e){

			}
		?>
		<button onclick="window.location.href = 'logout.php'">Sair da Conta</button>
		<button onclick="history.go(-1);">Voltar ao início</button>
	</div>
</body>
</html>