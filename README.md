# RussianPost
Russian Post helper library

Возможности библиотеки:
 - Заполнение формы наложенного платежа (Ф.112-ЭП)
 - Заполнение адресного ярлыка (Ф.7-П)
 - Получение стоимости доставки основываясь на индексе отправителя и индексе получателя, также может учитывать наложенный платеж и страхование посылки. *после очередных изменений на сервере почты России - не работает, можете поправить*

## Установка
```
composer require "cosmologist/russian-post:dev-master"
```

## Использование

### Заполнение формы наложенного платежа
```php
$filler = new Cosmologist\RussianPost\RemittanceBlankFiller();
$filler
    ->setAmount(9872.35) // Сумма наложенного платежа
    ->setRemittance(true) // Флаг "Наложенный платеж"
    ->setWithDelivery(true) // Флаг "C доставкой"
    ->setWithNotification(true) // Флаг "C уведомлением"
    ->setFromAddress('Россия, г. Москва, ул. Белых партизан, д. 18, кв. 116') // Адрес отправителя
    ->setFromAddressPostalCode(123456) // Индекс отправителя
    ->setFromName('Петров Петр Петрович') // Имя отправителя
    ->setToAddress('Россия, г. Саратов, ул. Ленина, д. 1, кв. 3') // Адрес получателя
    ->setToAddressPostalCode(987654) // Индекс получателя
    ->setToName('Иванов Иван Иванович') // Имя получателя
;

$filler->save('/tmp/pdf/1.pdf');
```

### Заполнение адресного ярлыка
```php
$filler = new \Cosmologist\RussianPost\AddressBlankFiller();
$filler
    ->setParcel(true) // Посылка?
    ->setWrapper(true) // Бандероль
    ->setWithSimpleNotification(true) // С простым уведомлением?
    ->setWithNotification(true) // С заказным уведомлением?
    ->setWithDeclaredValue(true) // С объявленной ценностью?
    ->setWithCashOnDelivery(true) // С наложенным платежом?
    ->setWithList(true) // С описью?
    ->setDeclaredValueAmount(2000) // Сумма объявленной ценности
    ->setCashOnDeliveryAmount(3000) // Сумма наложенного платежа
    ->setFromAddress('Россия, г. Москва, ул. Белых партизан, д. 18, кв. 116') // Адрес отправителя
    ->setFromAddressPostalCode(123456) // Индекс отправителя
    ->setFromName('Петров Петр Петрович') // Имя отправителя
    ->setToAddress('Россия, г. Саратов, ул. Ленина, д. 1, кв. 3') // Адрес получателя
    ->setToAddressPostalCode(987654) // Индекс получателя
    ->setToName('Иванов Иван Иванович') // Имя получателя

$filler->save('/tmp/pdf/1.pdf');
```

### Получение стоимости доставки
```php
$rp = new \Cosmologist\RussianPost\Calculator(new GuzzleHttp\Client());

$fromIndex = 107031;
$toIndex = 614016;
$weight = 1500;
$cashOnDeliverySum = 3000;
$insuranceSum = 3000;

var_dump($rp->calculateCost($fromIndex, $toIndex, $weight, $cashOnDeliverySum, $insuranceSum));
```
