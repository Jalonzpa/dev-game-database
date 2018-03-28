<?php 
session_start();
	include '../login.php'; 
	$connect=mysqli_connect($hn,$un,$pw,$db);
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>
 
<?php
 
// create a variable
$game_color=$_POST['game_color'];
$game_num=$_POST['game_num'];
$game_name=$_POST['game_name'];
$description=$_POST['description'];
$id = $_SESSION['id'];

echo $id;

 
//Execute the query
 $sql = "UPDATE `dev-main` SET color='$game_color', number='$game_num', game_name='$game_name', description='$description' WHERE id=$id";
 
 if ($connect->query($sql) === TRUE) {
	 echo "Record updated successfully";
} else {
	echo "Nope: ". $connect->error;
	
}	
//mysqli_query($connect,"UPDATE `dev-main` SET color=$game_color, number=$game_num, game_name=$game_name, description=$description WHERE id=$id");
//header('Location: /edit');    

?>
