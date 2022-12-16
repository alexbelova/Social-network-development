<?php
  require_once 'header.php';
  
  if (!$loggedin) die("</div></body></html>");
  
  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;
  
  if ($view == $user)
  {
    $name1 = $name2 = "Ваших";
	$name3 =          "Вы";
  }
  else
  {
    $name1 = "<a data-transition='slide'
	           href='members.php?view=$view'>$view</a>'s";
	$name2 = "$view's";
	$name3 = "$view is";
  }
  
  // Снимите комментарий со следующей строки кода,
  // если хотите, чтобы здесь был показан профиль пользователя
  showProfile($view);
  
  $followers = array();
  $following = array();
  
  $result = queryMysql("SELECT * FROM friends WHERE user='$view'");
  $num = $result->num_rows;
  
  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
	$followers[$j] = $row['friend'];
  }
  
  $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
  $num = $result->num_rows;
  
  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
	$following[$j] = $row['user'];
  }
  
  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = FALSE;
  echo "<br>";
  
  if (sizeof($mutual))
  {
    echo "<span class='subhead'>$name2 общие друзья</span><ul>";
	foreach($mutual as $friend)
	  echo "<li><a data-transition='slide'
	        href='members.php?view=$friend'>$friend</a>";
	echo "</ul>";
    $friends = TRUE;	
  }
  
  if (sizeof($followers))
  {
    echo "<span class='subhead'>$name2 подписчики</span><ul>";
	foreach($followers as $friend)
	  echo "<li><a data-transition='slide'
	        href='members.php?view=$friend'>$friend</a>";
	echo "</ul>";
    $friends = TRUE;	
  }
  
  if (sizeof($following))
  {
    echo "<span class='subhead'>$name3 подписки</span><ul>";
	foreach($following as $friend)
	  echo "<li><a data-transition='slide'
	        href='members.php?view=$friend'>$friend</a>";
	echo "</ul>";
    $friends = TRUE;	
  }
  
  if (!$friends) echo "<br>У вас ещё нет друзей.<br><br>";
  
  echo "<a data-role='button' data-transition='slide'
        href='messages.php?view=$view'>Просмотр $name2 сообщений</a>";
?>
    </div>
  </body>
</html>