<?php

// Обработчик запросов методом GET.
function admin_get($request) {
  // Достаем данные из БД, форматируем, санитизуем, складываем в массив, передаем в шаблон для вывода в HTML.
  /*
  $app=array(
    0=>"name",
    1=>"mail",
    2=>"date",
    3=>"sex",
    4=>"limb",
    5=>"bio"
  );
  $pw=array(
    0=>"power",
    1=>"id"
  );
  $values=array(
    //"name"=>"adads",
    //"mail"=>"somemail@ru",
    //"date"=>"1920",
    //"sex"=>"M",
    //"limb"=>"4",
    //"bio"=>"my name bro is one of greatest pirates"
    //"power"=>"бессмертие"
  );*/
  require_once('db.php');
  /*
  foreach($pw as $i){
    db_set('powers',$i,'id','12',$values[$i]);
  }*/
  
  $query=db_array(1,"SELECT * FROM application");
  $params = array();
  for($i=0;$i<count($query);$i++){
    $params[$i]=$query[$i];
  }
  
  $query=db_array(1,"SELECT * FROM powers");
  
  for($i=0;$i<count($params);$i++){
    $m=0;
    for($j=0;$j<count($query);$j++)
      if($params[$i]['id']==$query[$j]['id']){
        $params[$i]['powers'][$m]=$query[$j]['power'];
        $m++;
      }
  }
  // Пример возврата html из шаблона с передачей параметров.
  return theme('admin', ['admin' => $params]);
}

// Обработчик запросов методом POST.
function admin_post($request) {
  // Санитизуем параметр в URL и удаляем строку в БД.
  $id = intval($request[0]);
  // Пример возврата редиректа после обработки формы для реализации принципа Post-redirect-Get.
  return redirect('admin');
}
