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
    
    $query = "SELECT * FROM `dev-main` ORDER BY color, number";
    $results = $connect->query($query);
    if (!$results) die($connect->error);
    
    $rows = $results->num_rows;
    for ($j = 0 ; $j < $rows ; ++$j)
       {
          $results->data_seek($j);
          $row = $results->fetch_array(MYSQLI_ASSOC);
          $color = $row['color'];
          $number = $row['number'];
          $title = $row['game_name'];
          $description = $row['description'];
          $id = $row['id'];
          echo '<div class="container">';
          echo '<div class="row">';
          echo '<div class="col-4"><img src="images/'.$id.'.png"></div>';
          echo '<div class="col-1"></div>';
          echo '<div class="col-7">';
          echo '<div class="row">';
          echo '<div class="col-10"><h1>'.$title.'</h1></div>';
          echo '<div class="col-2"><button class="'.$color.'-button">'.$number.'</button></div></div>';
          echo '<div class="row">';
          echo '<div class="col-12"><p>'.$description.'</p></div>';
          echo '</div></div></div></div>';
        
        
          
       }
       
       //$result->close();
       //$connect->close();
?>

    		      
