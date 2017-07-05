<?php

namespace Cosmologist\RussianPost;

use mikehaertl\pdftk\Pdf;

/**
 * Fill the address form (F7P)
 */
class AddressBlankFiller
{
    /**
     * Form data
     *
     * @var array
     */
    protected $data = [

    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pdf = new Pdf(
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR .
            'F7P.pdf'
        );
    }

    /**
     * Set parcel flag (Посылка?)
     *
     * @param bool $parcel Is parcel? (Посылка?)
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
     * Set wrapper flag (Бандероль?)
     *
     * @param bool $wrapper Is wrapper? (Бандероль?)
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
     * Set with declared value flag (С объявленной ценностью?)
     *
     * @param bool $withDeclaredValue With declared value? (С объявленной ценностью?)
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
     * Set with cache on delivery flag (С наложенным платежом?)
     *
     * @param bool $withCashOnDelivery With cash on delivery? (С наложенным платежом?)
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
     * Set with a list flag (С описью?)
     *
     * @param bool $withList With a list? (С описью?)
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
     * Set with a simple notification (С простым уведомлением?)
     *
     * @param bool $withSimpleNotification With a simple notification? (С простым уведомлением?)
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
     * Set with a notification (С заказным уведомлением?)
     *
     * @param bool $withNotification With a notification? (С заказным уведомлением?)
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
     * Set declared value amount (Сумма объявленной ценности)
     *
     * @param int $amount Declared value amount (Сумма объявленной ценности)
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
     * Set cash on delivery (Сумма наложенного платежа)
     *
     * @param int $amount Cash on delivery (Сумма наложенного платежа)
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
     * Set from address (Адрес откуда, без индекса)
     *
     * @param string $address Address without postal-code
     *
     * @return $this
     */
    public function setFromAddress($address, $splitSeparator = ',')
    {
        $this->data['SenderAddress_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $address;

        return $this;
    }

    /**
     * Set from address postal-code (Индекс откуда)
     *
     * @param string $code From postal-code
     *
     * @return $this
     */
    public function setFromAddressPostalCode($code)
    {
        $this->data['SenderIndex_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $code;

        return $this;
    }

    /**
     * Set from name (от кого)
     *
     * @param string $name Name
     *
     * @return $this
     */
    public function setFromName($name)
    {
        $this->data['Sender_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $name;

        return $this;
    }

    /**
     * Set to address (Адрес куда, без индекса)
     *
     * @param string $address Address without postal-code
     * @param string $splitSeparator Address separator char (for splitting addresses by rows)
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
     * Set to address postal-code (Индекс куда)
     *
     * @param string $code To postal-code
     *
     * @return $this
     */
    public function setToAddressPostalCode($code)
    {
        $this->data['RecipientIndex_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $code;

        return $this;
    }

    /**
     * Set to name (кому)
     *
     * @param string $name Name
     *
     * @return $this
     */
    public function setToName($name)
    {
        $this->data['Recipient_46bc2a61-57f6-4b33-914f-f9fcb441d36f_94b61db7-4742-45c3-a499-42b4fb3701f2'] = $name;

        return $this;
    }

    public function save($path)
    {
        $this->pdf->fillForm($this->data);

        $result = $this->pdf->saveAs($path);

        if ($result === false) {
            throw new \RuntimeException($this->pdf->getError());
        }

        return $result;
    }
}