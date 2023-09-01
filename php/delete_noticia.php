<?php
	require('conecta.php');

	$tb = $_GET['tb'];
	$id = $_GET['id'];

	try {
		$delete = $conn->prepare("DELETE FROM $tb WHERE id='$id'");
		$delete->execute();
		header(sprintf('location: %s', $_SERVER['HTTP_REFERER']));
	} catch(PDOException $e) {
		header('location:..\index.php');
				}

?>