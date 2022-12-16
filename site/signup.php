<?php
  require_once 'header.php';
  
echo <<<_END
  <script>
    function checkUser(user)
	{
	  if (user.value == '')
	  {
	    $('#used').html('&nbsp;')
		return
	  }
	  
	  $.post
	  (
	    'checkuser.php',
		{ user : user.value },
		function(data)
		{
		  $('#used').html(data)
		}
	  )
	}
  </script>
_END;

  $error = $user = $pass = "";
  if (isset($_SESSION['user'])) destroySession();
  
  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
	$pass = sanitizeString($_POST['pass']);
	
	if ($user == "" || $pass == "")
	  $error = 'Были введены не все поля<br><br>';
	else
	{
	  $result = queryMysql("SELECT * FROM members WHERE user='$user'");
	  
	  if ($result->num_rows)
	    $error = 'Это имя пользователя уже существует<br><br>';
	  else
	  {
	    queryMysql("INSERT INTO members VALUES('$user', '$pass')");
		die('<h4>Учетная запись создана</h4>Пожалуйста, войдите в систему.</div></body></html>');
	  }
	}
  }
  
echo <<<_END
      <form method='post' action='signup.php'>$error
	  <div data-role='fieldcontain'>
	  <label></label>
	  Пожалуйста, введите свои данные, чтобы зарегистрироваться
	</div>
	<div data-role='fieldcontain'>
	<label>Имя пользователя</label>
	<input type='text' maxlength='16' name='user' value='$user'
	  onBlur='checkUser(this)'>
  </div>
  <div data-role='fieldcontain'>
	<label>Пароль</label>
	<input type='text' maxlength='16' name='pass' value='$pass'>
  </div>
  <div data-role='fieldcontain'>
	<label></label>
	<input data-transition='slide' type='submit' value='Регистрация'>
  </div>
 </div>
</body>
</html>
_END;
?>