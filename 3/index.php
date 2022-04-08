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
    //print('Спасибо, результаты сохранены.');
    print('<script type="text/javascript"> window.alert("Данные были сохранены")</script>');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
/*
if($_SERVER['REQUEST_METHOD'!='POST']){
  print_r('not post');
}
*/
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['fio'])) {
  print_r('Заполните имя.<br/>');
  $errors = TRUE;
}
if (empty($_POST['mail'])){
  print_r('Заполните почту.<br/>');
  $errors = TRUE;
}
if ($_POST['year']=='Выбрать'){
  print_r('Заполните год рождения.<br/>');
  $errors = TRUE;
}
if ($_POST['sex']!='M' and $_POST['sex']!='W'){
  print_r('Выберите пол.<br/>');
  $errors = TRUE;
}
if ($_POST['limb']<1 or $_POST['limb']>4){
  print_r('Выберите сколько у вас конечностей.<br/>');
  $errors = TRUE;
}
foreach($_POST['power'] as $power){
  if($power!='бессмертие' and $power!='прохождение сквозь стены' and $power!='левитация'){
    print_r('Выберите хотя бы одну суперспособность.<br/>');
    $errors=TRUE;
  }
}

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  print_r('Something is wrong');
  exit();
}

// Сохранение в базу данных.

$user = 'u41026';
$pass = '4433573';
$db = new PDO('mysql:host=localhost;dbname=u41026', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO application SET name=:name,mail=:mail,date=:date,sex=:sex,limb=:limb,bio=:bio");
  $stmt->bindParam(':name',$_POST['fio']);
  $stmt->bindParam(':mail',$_POST['mail']);
  $stmt->bindParam(':date',$_POST['year']);
  $stmt->bindParam(':sex',$_POST['sex']);
  $stmt->bindParam(':limb',$_POST['limb']);
  $stmt->bindParam(':bio',$_POST['bio']);
  $stmt -> execute();
  $id=$db->lastInsertId();
  $pwr=$db->prepare("INSERT INTO powers SET power=:power,id=:id");
  $pwr->bindParam(':id',$id);
  foreach($_POST['power'] as $power){
    $pwr->bindParam(':power',$power); 
    $pwr->execute();  
  }
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
?>
