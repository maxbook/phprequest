<?php
require './phprequest/phprequest.php';
$request = new Request();
$res = $request->get('http://www.google.com');
if (!$res['error'] && $res['statuscode'] == 200) {
  echo $res['body'];
}
else {
  echo $res['error'];
}
?>
