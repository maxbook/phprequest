<?php
require './Request/Request.php';
$request = new Request([
  'responseType' => 'json',
  'baseUrl' => 'http://api.openweathermap.org/data/2.5'
]);

$todayWeather = $request->get('/weather?id=6454414&lang=fr&appid=44db6a862fba0b067b1930da0d769e98');

var_dump($todayWeather['body']);
?>
