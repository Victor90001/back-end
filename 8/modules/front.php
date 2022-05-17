<?php

// Обработчик запросов методом GET.
function front_get($request) {
  $values=array(
    'name'=>'name',
    'mail'=>'mail',
  );
  $errors=array(
    'name'=>TRUE,
    'mail'=>FALSE
  );
  $params=array(
    'values'=>$values,
    'errors'=>$errors
  );
  return theme('page',['#content'=>$params]);
  // Пример ответа веб-сервиса.
  return array('headers' => array('Content-Type' => 'application/xml'), 'entity' => '<document />');
  // Пример возврата контента.
  return '123';
  // Пример запрета доступа.
  return access_denied();
  // Пример возврата ресурс не найден.
  return not_found();
}

// Обработчик запросов методом POST.
function front_post($request) {
  // Пример возврата редиректа.
  return redirect('new-location');
}