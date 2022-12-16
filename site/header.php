<?php //
  session_start();

echo <<<_INIT
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
	<link rel='stylesheet' href='styles.css'>
	<script src='javascript.js'></script>
	<script src='jquery-2.2.4.min.js'></script>
	<script src='jquery.mobile-1.4.5.min.js'></script>
	
_INIT;

  require_once 'functions.php';
  
  $userstr = 'Добро пожаловать гость';
  
  if (isset($_SESSION['user']))
  {
    $user = $_SESSION['user'];
	$loggedin = TRUE;
	$userstr = "Вошли в систему как: $user";
  }
  else $loggedin = FALSE;
  
echo <<<_MAIN
    <title>Щебет птиц: $userstr</title>
  </head>
  <body>
    <div data-role='page'>
	  <div data-role='header'>
	    <div id='logo'
		  class='center'><img id='559603025' src='559603025.gif'>Щебет птиц</div>
		<div class='username'>$userstr</div>
	  </div>
	  <div data-role='content'>
	  
_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
    <div class='center'>
	  <a data-role='button' data-inline='true' data-icon='home'
	    data-transition="slide" href='members.php?view=$user'>Главная</a>
	  <a data-role='button' data-inline='true'
	    data-transition="slide" href='members.php'>Участники</a>
	  <a data-role='button' data-inline='true'
	    data-transition="slide" href='friends.php'>Друзья</a>
	  <a data-role='button' data-inline='true'
	    data-transition="slide" href='messages.php'>Сообщения</a>
	  <a data-role='button' data-inline='true'
	    data-transition="slide" href='profile.php'>Редактировать профиль</a>
	  <a data-role='button' data-inline='true'
	    data-transition="slide" href='logout.php'>Выход</a>
	</div>
	
_LOGGEDIN;
  }
  else
  {
echo <<<_GUEST
    <div class='center'>
	  <a data-role='button' data-inline='true' data-icon='home'
	    data-transition="slide" href='index.php'>Главная</a>
	  <a data-role='button' data-inline='true' data-icon='plus'
	    data-transition="slide" href='signup.php'>Регистрация</a>
	  <a data-role='button' data-inline='true' data-icon='check'
	    data-transition="slide" href='login.php'>Вход</a>
	</div>
	<p class='info'>(Вы должны войти в систему, чтобы использовать это приложение)</p>

_GUEST;
  }
?>