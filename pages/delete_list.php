<?php
	$list_id= $_GET['id'];

	$database = new Database();

	$database->query('DELETE FROM list WHERE id = :id');
	$database->bind(':id',$list_id);
	$database->execute();

	if($database->rowCount()>0){
		header('Location:index.php?msg=listdeleted');
	}
?>