<?php 
	include '../login.php'; 
	$connect=mysqli_connect($hn,$un,$pw,$db);
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>
<link rel="stylesheet" href="css/style.css" type="text/css">
<?php
$play_num =$_POST['player'];

switch ($play_num) {
    case "A":
        $player="Single";
        break;
    case "B":
        $player="Multiplayer";
        break;
    case "C":
        $player="Read-Along";
        break;
    default:
    	$player=0;
        break;
}

   $query = "SELECT color, number, game_name, id FROM `dev-main` WHERE player_number = '{$player}' ORDER BY color, number";
    
    
    $results = $connect->query($query);
    if (!$results) die($connect->error);
    
    $rows = $results->num_rows;
   $j=0; 
   while ($j < $rows)
       {  
         
          echo '<div class="row">';
          for ($i = 0 ; $i < 3 && $j < $rows ; $i++){
	          $results->data_seek($j);
	          $row = $results->fetch_array(MYSQLI_ASSOC);
	          $color = $row['color'];
	          $number = $row['number'];
	          $title = $row['game_name'];
	          $id = $row['id'];
	          echo '<div class="col-4">';
	          echo '<div class="row"><h2>'.$title.'</h2></div>';
	          echo '<div class="row"><div class="col-6"><img src="images/'.$id.'.png"></div>';
	          echo '<div class="col-6"><button class="'.$color.'-button">'.$number.'</button></div></div></div>';
	          $j++;}
	 echo '</div>';
          
          
         
        
        
          
       }
       
       //$result->close();
       //$connect->close();
?>