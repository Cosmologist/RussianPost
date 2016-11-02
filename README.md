# RussianPost
Russian Post delivery cost calculation

Простая библиотека для расчета стоимости доставки посылки Почтой России.
Позволяет узнать стоимость доставки основываясь на индексе отправителя и индексе получателя, также может учитывать наложенный платеж и страхование посылки.

## Installation
Add the following dependency to your composer.json:

```
"cosmologist/russian-post": "dev-master"
```

## Usage
```php
<?php

use GuzzleHttp\Client;

$rp = new \Cosmologist\RussianPost\Calculator(new Client());

$fromIndex = 107031;
$toIndex = 614016;
$weight = 1500;
$cashOnDeliverySum = 3000;
$insuranceSum = 3000;

var_dump($rp->calculateCost($fromIndex, $toIndex, $weight, $cashOnDeliverySum, $insuranceSum));
```
