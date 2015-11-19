Console logger
=======================================================

Dumps output to console, for console application debugging

[![Latest Stable Version](https://poser.pugx.org/pahanini/yii2-consolelog/v/stable)](https://packagist.org/packages/pahanini/yii2-consolelog) [![Total Downloads](https://poser.pugx.org/pahanini/yii2-consolelog/downloads)](https://packagist.org/packages/pahanini/yii2-consolelog) [![Latest Unstable Version](https://poser.pugx.org/pahanini/yii2-consolelog/v/unstable)](https://packagist.org/packages/pahanini/yii2-consolelog) [![License](https://poser.pugx.org/pahanini/yii2-consolelog/license)](https://packagist.org/packages/pahanini/yii2-consolelog)


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

You also can customize color scheme using color property.
