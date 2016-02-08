# PHPRequest - lightweight PHP HTTP client

## Super simple to use

```php
require './Request.php';
$request = new Request();
$res = $request->get('http://www.google.com');
echo $res; // Show the HTML for the Google homepage.
```

## Table of contents

- [Streaming](#streaming)
- [Forms](#forms)
- [HTTP Authentication](#http-authentication)
- [Custom HTTP Headers](#custom-http-headers)
- [OAuth Signing](#oauth-signing)
- [Proxies](#proxies)
- [Unix Domain Sockets](#unix-domain-sockets)
- [TLS/SSL Protocol](#tlsssl-protocol)
- [Support for HAR 1.2](#support-for-har-12)
- [**All Available Options**](#requestoptions-callback)

---
