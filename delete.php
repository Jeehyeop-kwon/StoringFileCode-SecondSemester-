<?php 

	ob_start();

	require('db.php'); 
	

	$sql = "DELETE FROM pictures;"; 

	$cmd = $conn->prepare($sql); 

	$cmd->execute(); 

	$cmd->closeCursor();


	ob_flush();

	require('images.php');
?>