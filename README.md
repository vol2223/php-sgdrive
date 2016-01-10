# How To Use

```
<?php

require_once('vendor/autoload.php');

$CLIENT_ID = 'hogehogehogehogehogehoge';
$CLIENT_EMAIL = 'piyo@hogehoge.gserviceaccount.com';
$CLIENT_KEY_PATH = './hogehoge.p12';
$CLIENT_KEY_PW = 'notasecret';

$auth = new Vol2223\Sgdrive\GoogleDriveAuth(
	$CLIENT_ID,
	$CLIENT_EMAIL,
	$CLIENT_KEY_PATH,
	$CLIENT_KEY_PW
);

$row = [
	'id' => '1', 'name' => 'poppy',
];
$client = new Vol2223\Sgdrive\Client($auth);
$client->api('test1', 'sheet1', 'insert')->insert($row);
```
