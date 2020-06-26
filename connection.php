<?php




//database connection
$mysqli = new mysqli("localhost","root","","interns");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if(!mysqli_select_db($mysqli,'interns'))
{
  echo 'Not Selected the Database';
}

?>
