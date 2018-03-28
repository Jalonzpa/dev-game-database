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
$game_age=$_POST['game_age'];
$game_player_num=$_POST['game_player_num']; 
$description=$_POST['description'];
$id = $_SESSION['id'];

echo $id;

 
//Execute the query
 $sql = "UPDATE `dev-main` SET color='$game_color', number='$game_num', game_name='$game_name', description='$description', age='$game_age', player_number='$game_player_num' WHERE id=$id";
 
 if ($connect->query($sql) === TRUE) {
	 echo "Record updated successfully";
} else {
	echo "Nope: ". $connect->error;
	
}	
header('Location: /edit');    

?>
