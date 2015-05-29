Console logger
=======================================================

Dumps output to console, for console application debugging


Installation
------------

Add

```
"pahanini/yii2-consolelog": "*"
```

to the require section of your `composer.json` file.


Usage
-----


```php
return [
	'id' => 'app-console',
	'bootstrap' => ['log'],
	'components' => [
		'log' => [
			'targets' => [
				[
					'class' => 'pahanini\log\ConsoleTarget',
					'levels' => ['error', 'warning', 'trace'],
				]
			],
		],
	],
	'params' => $params,
];
```
