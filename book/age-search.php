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

$play_age =$_POST['age'];

switch ($play_age) {
    case "A":
        $age="Under 3";
        break;
    case "B":
        $age="3+";
        break;
    case "C":
        $age="4+";
        break;
    case "D":
        $age="5+";
        break;
    case "E":
        $age="6+";
        break;
    case "F":
        $age="7+";
        break;
    case "G":
        $age="8+";
        break;
    case "H":
        $age="10+";
        break;
    default:
    	$age=0; 
        break;
}
   $query = "SELECT color, number, game_name, id FROM `dev-main` WHERE age = '{$age}' ORDER BY color, number";
    
    
    $results = $connect->query($query);
    if (!$results) die($connect->error);
    
    $rows = $results->num_rows;
   $j=0; 
   while ($j < $rows)
       {  
         
          echo '<div class="row">';
          for ($i = 0 ; $i < 3 && $j < $rows; $i++){
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