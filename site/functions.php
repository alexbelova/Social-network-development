<?php
  $dbhost = 'localhost';
  $dbname = 'mysite';
  $dbuser = 'root';
  $dbpass = 'mysql';
  
  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error");
  
  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
	echo "Таблица '$name' создана или уже существовала<br>";
  }
  
  function queryMysql($query)
  {
    global $connection;
	$result = $connection->query($query);
	if (!$result) die("Fatal Error");
	return $result;
  }
  
  function destroySession()
  {
    $_SESSION=array();
	if (session_id() != "" || isset($_COOKIE[session_name()]))
	  setcookie(session_name(), '', time()-2592000, '/');
	  
	session_destroy();
  }
  
  function sanitizeString($var)
  {
    global $connection;
	$var = strip_tags($var);
	$var = htmlentities($var);
	if (get_magic_quotes_gpc())
	  $var = stripslashes($var);
	return $connection->real_escape_string($var);
  }
  
  function showProfile($user)
  {
    if (file_exists("$user.jpg"))
	echo "<img src='$user.jpg' align='left'>";
	
	$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
	
	if ($result->num_rows)
	{
	  $row = $result->fetch_array(MYSQLI_ASSOC);
	  echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
	}
	else echo "<p>Здесь пока не на что смотреть</p><br>";
  }
?>