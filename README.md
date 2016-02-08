# PHPRequest - Lightweight PHP HTTP client

## Super simple to use
Request is designed to be the simplest way possible to make http calls in PHP.
```php
require 'phprequest.php';
$request = new Request();
$res = $request->get('http://www.google.com');
if (!$res['error'] && $res['statuscode'] == 200) {
  echo $res['body'];  // Show the HTML for the Google homepage.
}
else {
  echo $res['error'];
}
```

## Table of contents

- [Request defaults](#streaming)
- [Request response](#streaming)
- [Post](#forms)
- [Get](#http-authentication)
- [Patch](#http-authentication)
- [Delete](#http-authentication)
- [Custom request](#http-authentication)
- [Response type](#response-type)
- [Custom HTTP Headers](#custom-http-headers)

---
