<?php

namespace Cosmologist\RussianPost\Form;

use Cosmologist\RussianPost\Helper\MoneyString;

/**
 * Заполнение формы адресного ярлыка (ф. 7-п)
 */
class AddressForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct(
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'bin' . DIRECTORY_SEPARATOR .
            'F7P.pdf'
        );
    }

    /**
     * Устанавливает флаг посылки
     *
     * @param bool $parcel Флаг посылки
     *
     * @return $this
     */
    public function setParcel($parcel)
    {
        $this->data['Parcel_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($parcel ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг бандероли
     *
     * @param bool $wrapper Флаг бандероли
     *
     * @return $this
     */
    public function setWrapper($wrapper)
    {
        $this->data['Banderol_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($wrapper ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг "С объявленной ценностью"
     *
     * @param bool $withDeclaredValue Флаг "С объявленной ценностью"
     *
     * @return $this
     */
    public function setWithDeclaredValue($withDeclaredValue)
    {
        $this->data['Insured_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($withDeclaredValue ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг "С наложенным платежом"
     *
     * @param bool $withCashOnDelivery Флаг "С наложенным платежом"
     *
     * @return $this
     */
    public function setWithCashOnDelivery($withCashOnDelivery)
    {
        $this->data['CashOnDelivery_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($withCashOnDelivery ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг "С описью"
     *
     * @param bool $withList Флаг "С описью"
     *
     * @return $this
     */
    public function setWithList($withList)
    {
        $this->data['WithInventory_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($withList ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг "С простым уведомлением"
     *
     * @param bool $withSimpleNotification Флаг "С простым уведомлением"
     *
     * @return $this
     */
    public function setWithSimpleNotification($withSimpleNotification)
    {
        $this->data['SimpleNotification_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($withSimpleNotification ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает флаг "С заказным уведомлением"
     *
     * @param bool $withNotification Флаг "С заказным уведомлением"
     *
     * @return $this
     */
    public function setWithNotification($withNotification)
    {
        $this->data['OrderedNotification_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            ($withNotification ? '0' : 'Off');
        return $this;
    }

    /**
     * Устанавливает сумму объявленной ценности
     *
     * @param int $amount Сумма объявленной ценности
     *
     * @return $this
     */
    public function setDeclaredValueAmount($amount)
    {
        $this->data['SummInsured_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            MoneyString::convert((int)$amount, false);

        return $this;
    }

    /**
     * Устанавливает сумму наложенного платежа
     *
     * @param int $amount Сумма наложенного платежа
     *
     * @return $this
     */
    public function setCashOnDeliveryAmount($amount)
    {
        $this->data['SummCashOnDelivery_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] =
            MoneyString::convert((int)$amount, false);

        return $this;
    }

    /**
     * Устанавливает адрес отправителя (без индекса)
     *
     * @param string $address Адрес отправителя (без индекса)
     *
     * @return $this
     */
    public function setFromAddress($address)
    {
        $this->data['SenderAddress_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $address;

        return $this;
    }

    /**
     * Устанавливает индекс отправителя
     *
     * @param string $code Индекс отправителя
     *
     * @return $this
     */
    public function setFromAddressPostalCode($code)
    {
        $this->data['SenderIndex_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $code;

        return $this;
    }

    /**
     * Устанавливает ФИО отправителя
     *
     * @param string $name ФИО отправителя
     *
     * @return $this
     */
    public function setFromName($name)
    {
        $this->data['Sender_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $name;

        return $this;
    }

    /**
     * Устанавливает адрес получателя
     *
     * @param string $address Адрес получателя
     * @param string $splitSeparator Символ разделителя в адресе (необходимо для разбиения длинного адреса на несколько строк)
     *
     * @return $this
     */
    public function setToAddress($address, $splitSeparator = ',')
    {
        $lineCharsLimit = 60;
        $addressSeparator = ', ';

        $line = '';
        $lines = [];
        $parts = explode($splitSeparator, $address);
        foreach ($parts as $part) {
            $part = trim($part);

            if ((strlen($line) + strlen($part) + strlen($addressSeparator)) > $lineCharsLimit) {
                $lines[] = $line;
                $line = '';
            }

            if (strlen($line) !== 0) {
                $line .= $addressSeparator;
            }
            $line .= $part;
        }
        $lines[] = $line;

        if (isset($lines[0])) {
            $this->data['RecipientAddress_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2']
                = $lines[0];
        }
        if (isset($lines[1])) {
            $this->data['RecipientAddress_2_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2']
                = $lines[1];
        }
        if (isset($lines[2])) {
            $this->data['RecipientAddress_3_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2']
                = $lines[2];
        }

        return $this;
    }

    /**
     * Устанавливает индекс получателя
     *
     * @param string $code Индекс получателя
     *
     * @return $this
     */
    public function setToAddressPostalCode($code)
    {
        $this->data['RecipientIndex_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $code;

        return $this;
    }

    /**
     * Устанавливает ФИО получателя
     *
     * @param string $name ФИО получателя
     *
     * @return $this
     */
    public function setToName($name)
    {
        $this->data['Recipient_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $name;

        return $this;
    }
}