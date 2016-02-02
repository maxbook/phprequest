# Example

```
<?php
require './Request/Request.php';
$request = new Request([
  'responseType' => 'json',
  'baseUrl' => 'http://api.openweathermap.org/data/2.5'
]);

$todayWeather = $request->get('/weather?id=6454414&lang=fr&appid=44db6a862fba0b067b1930da0d769e98');

var_dump($todayWeather['body']);
?>
```

### Result

```
object(stdClass)#2 (12) {
  ["coord"]=>
  object(stdClass)#3 (2) {
    ["lon"]=>
    float(3.07)
    ["lat"]=>
    float(50.63)
  }
  ["weather"]=>
  array(1) {
    [0]=>
    object(stdClass)#4 (4) {
      ["id"]=>
      int(500)
      ["main"]=>
      string(4) "Rain"
      ["description"]=>
      string(16) "légères pluies"
      ["icon"]=>
      string(3) "10d"
    }
  }
  ["base"]=>
  string(12) "cmc stations"
  ["main"]=>
  object(stdClass)#5 (7) {
    ["temp"]=>
    float(281.339)
    ["pressure"]=>
    float(1021.7)
    ["humidity"]=>
    int(97)
    ["temp_min"]=>
    float(281.339)
    ["temp_max"]=>
    float(281.339)
    ["sea_level"]=>
    float(1029.01)
    ["grnd_level"]=>
    float(1021.7)
  }
  ["wind"]=>
  object(stdClass)#6 (2) {
    ["speed"]=>
    float(7.56)
    ["deg"]=>
    float(266.004)
  }
  ["rain"]=>
  object(stdClass)#7 (1) {
    ["3h"]=>
    float(0.55)
  }
  ["clouds"]=>
  object(stdClass)#8 (1) {
    ["all"]=>
    int(80)
  }
  ["dt"]=>
  int(1454423224)
  ["sys"]=>
  object(stdClass)#9 (4) {
    ["message"]=>
    float(0.0031)
    ["country"]=>
    string(2) "FR"
    ["sunrise"]=>
    int(1454397704)
    ["sunset"]=>
    int(1454431307)
  }
  ["id"]=>
  int(6454414)
  ["name"]=>
  string(5) "Lille"
  ["cod"]=>
  int(200)
}
```
