<?php
  session_start();

  if (isset($_SESSION['username']))
  {
	echo "<html>";
    echo "<body>";
    echo "<div class=\"grid\">";
	  echo "<div class=\"row\">";
		echo "<img src=images/trees.jpg width=\"100%\">";
	echo "</div>";
	echo "<div class=\"row\">";
		echo "<div class=\"col-3\">";
		echo "<h1>";
		echo "<a href=\"/../entry\">Add Games</a>";
		echo "</h1>";
		echo "</div>";
		echo "<div class=\"col-3\"></div>";
		echo "<div class=\"col-3\">";
		echo "<h1>";
		echo "<a href=\"../book/query.php\">View Book</a>";
		echo "</h1>";
		echo "</div>";
		echo "<div class=\"col-3\">";
		echo "<h1>";
		echo "<a href=\"../edit/\">Edit</a>";
		echo "</h1>";
		echo "</div>";
		echo "<div class=\"col-3\">";
		echo "<h1>";
		echo "<a href=\"../book/book-index.php\">Print Index</a>";
		echo "</h1>";
		echo "</div>";
		
	  echo "</div>";
  echo "</div>";
  echo "</html>";
}

  else echo "Please <a href='index.php'>click here</a> to log in.";
?>

 
</body>
</html>
