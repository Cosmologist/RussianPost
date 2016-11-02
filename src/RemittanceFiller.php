<?php

namespace Cosmologist\RussianPost;

use mikehaertl\pdftk\Pdf;

/**
 * Fill the remittance form (112EP)
 */
class RemittanceFiller
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
            '112EP.pdf'
        );
    }

    /**
     * Set amount (сумма)
     *
     * @param float $amount Amount (сумма)
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->data['пропись'] = NumericString::convert($amount);
        $this->data['руб']     = (int) $amount;
        $this->data['коп']     = str_pad((int) ($amount - floor($amount)) * 100, 2, 0);

        return $this;
    }

    /**
     * Set remittance (наложенный платеж?)
     *
     * @param bool $remittance Remittance? (наложенный платеж?)
     *
     * @return $this
     */
    public function setRemittance($remittance)
    {
        $this->data['наложенный_платеж'] = ($remittance ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Set remittance (наложенный платеж?)
     *
     * @param bool $withDelivery With delivery? (с доставкой?)
     *
     * @return $this
     */
    public function setWithDelivery($withDelivery)
    {
        $this->data['с_доставкой_на_дом'] = ($withDelivery ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Set remittance (наложенный платеж?)
     *
     * @param bool $withNotification With notification? (с уведомлением?)
     *
     * @return $this
     */
    public function setWithNotification($withNotification)
    {
        $this->data['с_уведомлением'] = ($withNotification ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Set from address (Адрес откуда, без индекса)
     *
     * @param string $address Address without postal-code
     *
     * @return $this
     */
    public function setFromAddress($address)
    {
        $this->data['адрес_отправителя'] = $address;

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
        $this->data['индекс_адреса_отправителя'] = $code;

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
        $this->data['от_кого'] = $name;

        return $this;
    }

    /**
     * Set to address (Адрес куда, без индекса)
     *
     * @param string $address Address without postal-code
     *
     * @return $this
     */
    public function setToAddress($address)
    {
        $this->data['куда'] = $address;

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
        $this->data['индекс_куда'] = $code;

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
        $this->data['кому'] = $name;

        return $this;
    }

    public function save($path)
    {
        $this->pdf->fillForm($this->data);

        return $this->pdf->saveAs($path);
    }
}