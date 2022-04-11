<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
if (!empty($_SESSION['login'])) {
  // Если есть логин в сессии, то пользователь уже авторизован.
  // TODO: Сделать выход (окончание сессии вызовом session_destroy()
  //при нажатии на кнопку Выход).
  // Делаем перенаправление на форму.
  header('Location: ./');
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<style>
  .form-sign-in{
    max-width: 960px;
    text-align: center;
    margin: 0 auto;
  }
</style>
<div class="form-sign-in">
<form action="login.php" method="post">
  <input name="login" /><br>
  <input name="pass" /><br>
  <input type="submit" value="Войти" />
</form>
</div>
<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {

  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  // Выдать сообщение об ошибках.
  $l=$_POST['login'];
  $p=$_POST['pass'];
  $uid=0;
  $error=FALSE;
  $user = 'u41026';
  $pass = '4433573';
  $db1 = new PDO('mysql:host=localhost;dbname=u41026', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  try{
    $chk=$db1->prepare("select id,login,pass from username");
    $chk->execute();
    $usernames=$chk->fetchALL();
    foreach($usernames as $username){
      if($username['login']==$l and password_verify($p,$username['pass'])){
        $uid=$username['id'];
        print($uid);
        $error=FALSE;
      }
    }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  if($error==TRUE){
    print('Исправьте ошибки <br>');
    session_destroy();
    exit();
  }
  // Если все ок, то авторизуем пользователя.
  $_SESSION['login'] = $l;
  print_r($_SESSION['login'].' ');
  // Записываем ID пользователя.
  $_SESSION['uid'] = $uid;
  print_r($_SESSION['uid']);
  // Делаем перенаправление.
  header('Location: /');
}
