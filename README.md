# RussianPost
Russian Post helper library

Возможности библиотеки:
 - Заполнение формы наложенного платежа (Ф.112-ЭП)
 - Заполнение адресного ярлыка (Ф.7-П)

## Установка
```
composer require "cosmologist/russian-post:dev-master"
```

## Использование

### Заполнение формы наложенного платежа
```php
$filler = new Cosmologist\RussianPost\Form\RemittanceForm();
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

echo $filler->generate(); // путь к pdf-файлу во временной директории 
```

### Заполнение адресного ярлыка
```php
$filler = new \Cosmologist\RussianPost\Form\AddressForm();
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

echo $filler->generate(); // путь к pdf-файлу во временной директории
```

### Использование заранее сконфигурированных профилей для заполнения форм
```php
// Заполняем форму динамическими данные
$form = new AddressForm();
$form
    ->setAmount(9872.35) // Сумма наложенного платежа
    ->setToAddress('Россия, г. Саратов, ул. Ленина, д. 1, кв. 3') // Адрес получателя
    ->setToAddressPostalCode(987654) // Индекс получателя
    ->setToName('Иванов Иван Иванович') // Имя получателя

$filler = new Filler([
        'address' => [
            'remittance'            => true,
            'withDelivery'          => true,
            'withNotification       => true,
            'fromAddress'           => 'Россия, г. Москва, ул. Белых партизан, д. 18, кв. 116'),
            'fromAddressPostalCode' => 123456,
            'fromName'              => 'Петров Петр Петрович'
        ]
]);

$this->filler->fill($form, 'address');

$form->save($path);
```

#### Список доступных полей форм
Форма адресного ярлыка:
```
parcel: <Флаг посылки (true/false)>
wrapper: <Флаг бандероли (true/false)>

toAddress: <Адрес получателя>
toAddressPostalCode: <Почтовый индекс получателя>
toName: <ФИО получателя>
fromAddress: <Адрес отправителя>
fromAddressPostalCode: <Почтовый индекс отправителя>
fromName: <ФИО отправителя>

cashOnDeliveryAmount: <сумма наложенного платежа>
declaredValueAmount: <сумма объявленной ценности>
withCashOnDelivery: <Флаг наложенного платежа (true/false)>
withDeclaredValue: <Флаг объявленной ценности (true/false)>
withList: <Флаг описи (true/false)>
withNotification: <Флаг заказного уведомления (true/false)>
withSimpleNotification: <Флаг простого уведомления (true/false)>
```

Форма наложенного платежа
```
FromAddress: <Адрес отправителя>
FromAddressPostalCode: <Почтовый индекс отправителя>
FromName: <ФИО отправителя>
ToAddress: <Адрес получателя>
ToAddressPostalCode: <Почтовый индекс получателя>
ToName: <Имя получателя>

Account: <Расчётный счет>
Amount: <Сумма перевода>
BankName: <Именование банка>
Bik: <БИК>
CorrespondentAccount: <Кореспондентский счёт>
Inn: <ИНН>

Remittance: <Флаг наложенного платежа (true/false)>
WithDelivery: <Флаг доставки на дом (true/false)>
WithNotification: <Флаг уведомления (true/false)>
```