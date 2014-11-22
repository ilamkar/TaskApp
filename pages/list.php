<?php 
$list_id  =  $_GET['id'];

// Instianate Database object
$database  = new Database();

//Query
$database->query('SELECT * FROM list WHERE id = :id');
$database->bind(':id',$list_id);
$row = $database->single();

echo '<h1>'.$row['list_name'].'</h1>';
echo '<p>'.$row['list_body'].'</p>';
echo '<a href = "?page= edit_list&id ='.$row['id'].'">Edit List</a> |';
echo '<a href ="?page=delete_list&id='.$row['id'].'">Delete List</a>';

//Instiance Database object
$database = new Database();

//Query
$database->query('SELECT * FROM tasks WHERE list_id =:list_id AND is_complete = :is_complete');
$databse->bind(':list_id',$list_id);
$database->bind(':is_complete',0);
$rows = $database->resultset();

echo '<h3>Tasks</h3>';
if($rows){
	echo '<ul class = "items">';
foreach($rows as $task){
	echo '<li><a href = "page=task&id='.$task['id'].'">'.$task['task_name'].'</a></li>';
}
	echo '</ul>';
}	else{
	echo 'No task for this list - <a href="index.php?page=new_task&listid='.$_GET['id'].'">Create one now</a>';
}