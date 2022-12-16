<?php
  require_once 'header.php';
  
  echo "<div class='center'>Добро пожаловать в сообщество,";
  if ($loggedin) echo " $user, Вы вошли в приложение";
else            echo ' пожалуйста, зарегистрируйтесь или войдите';

echo <<<_END
    </div><br>
  </div>
 </body>
</html>
_END;
?> 