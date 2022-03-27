<html>
  <style>
      .form1{
          max-width: 960px;
          text-align: center;
          margin: 0 auto;
      }
  </style>
  <body>
    <div class="form1">
    <form action="" method="POST">
      <label> ФИО </label> <br>
      <input name="fio" /> <br>
      <label> Почта </label> <br>
      <input name="mail" type="email" /> <br>
      <label> Дата рождения </label> <br>
      <input name="year" type="date" /> <br>
      <label> Ваш пол </label> <br>
      <div>
        <input name="sex" type="radio" value="male" />
        <input name="sex" type="radio" value="female" />
      </div>
      <label> Сколько у вас конечностей </label> <br>
      <div>
        <input name="limb" type="radio" value="1" />
        <input name="limb" type="radio" value="2" />
        <input name="limb" type="radio" value="3" />
        <input name="limb" type="radio" value="4" />
      </div>
      <label> Выберите суперспособности </label> <br>
      <select name="power" size="3" multiple>
        <option value="1">Бессмертие</option>
        <option value="2">Прохождение сквозь стены</option>
        <option value="3">Левитация</option>
      </select> <br>
      <label> Краткая биография </label> <br>
      <textarea name="bio" rows="10" cols="15"></textarea> <br>
      <input name="priv" type="checkbox"> Вы согласны с пользовательским соглашением <br>
      <input type="submit" value="Отправить" />
    </form>
    </div>
  </body>
</html>
<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['fio'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
else
  if (empty($_POST['mail'])){
    print('Заполните почту.<br/>');
    $errors = TRUE;
  }
  else
    if (empty($_POST['year'])){
      print('Заполните дату рождения.<br/>');
      $errors = TRUE;
    }
    else
      if (!isset($_POST['sex'])){
        print('Выберите пол.<br/>');
        $errors = TRUE;
      }
      else
        if (!isset($_POST['limb'])){
          print('Выберите сколько у вас конечностей.<br/>');
          $errors = TRUE;
        }
        else
          if (sele($_POST['limb'])){
            print('Выберите сколько у вас конечностей.<br/>');
            $errors = TRUE;
          }

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u41026';
$pass = '4433573';
$db = new PDO('mysql:host=localhost;dbname=u41026', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application (name) SET name = ?");
  $stmt -> execute(array('fio'));
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(array('label'=>'perfect', 'color'=>'green'));
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');