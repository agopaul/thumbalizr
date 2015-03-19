# thumbalizr

A simple wrapper for [thumbalizr.com](http://thumbalizr.com), an API for webpage screenshot.

## Usage

```php
<?php

$req = new \Thumbalizr\Request();
$req->setUrl("http://google.com");
$req->setWidth(1280);

$wrapper = new \Thumbalizr\Thumbalizr("API_KEY");
$wrapper->resize($req, __DIR__."/test-api.jpg");
```