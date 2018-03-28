<?php
  session_start();

  if (isset($_SESSION['username']))
  {
	  
	include '../login.php'; 
	$connect=mysqli_connect($hn,$un,$pw,$db);
 
		if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
    // create a variable
	$game_color=$_POST['color'];
	$game_num=$_POST['number'];
  
   $query = "SELECT * FROM `dev-main` WHERE color = '$game_color' AND number = '$game_num'";
    $results = $connect->query($query);
    if (!$results) die($connect->error);
    
    $rows = $results->num_rows;
   // for ($j = 0 ; $j < $rows ; ++$j)
     //  {
          $results->data_seek(0);
          $row = $results->fetch_array(MYSQLI_ASSOC);
          $color = $row['color'];
          $number = $row['number'];
          $title = $row['game_name'];
          $description = $row['description'];
          $age = $row['age'];
          $player_number = $row['player_number']; 
          $_SESSION['id'] = $row['id'];
          $id = $row['id']; 
?>	<h2>The ID for this game is: <?php echo $id; ?></h2>
          <form method="post" action="process.php">
		<label>Game Color    </label>
		<input type="text" name="game_color" value="<?php echo $color; ?>"/>
		<br>
		<label>Number    </label>
		<input type="text" name="game_num" value="<?php echo $number; ?>"  />
		<br>
		<label>Name    </label>
		<textarea rows="1" cols="100" name="game_name" > <?php echo $title; ?> </textarea>
		<br>
		<label>Age    </label>
		<input type="text" name="game_age" value="<?php echo $age; ?>"/>
		<br>
		<label>Number of Players    </label>
		<input type="text" name="game_player_num" value="<?php echo $player_number; ?>"/>
		<br>
		<label>Description    </label>
		<textarea rows="10" cols="100" name="description" > <?php echo $description; ?> </textarea>
		<br>
		
		<input type="submit" value="Add Game">
		</form>
	<h1> 
	<a href="../home/home.php">Go Home</a>
	</h1> 
<?php 		
      // }
  }
  
  else echo "Please <a href='../authtest.php'>click here</a> to log in.";
?>
