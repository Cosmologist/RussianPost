<?php

namespace Cosmologist\RussianPost\Form;

use Cosmologist\RussianPost\Form\AbstractForm;
use Cosmologist\RussianPost\Helper\MoneyString;

/**
 * Заполнение формы почтового перевода (ф.112ЭП)
 */
class RemittanceForm extends AbstractForm
{
    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct(
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'bin' . DIRECTORY_SEPARATOR .
            '112EP.pdf'
        );
    }

    /**
     * Устанавливает сумму перевода
     *
     * @param float $amount Сумма перевода
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->data['пропись'] = MoneyString::convert($amount);
        $this->data['руб']     = (int) $amount;
        $this->data['коп']     = str_pad((int) ($amount - floor($amount)) * 100, 2, 0);

        return $this;
    }

    /**
     * Устанавливает флаг наложенного платежа
     *
     * @param bool $remittance Флаг наложенного платежа
     *
     * @return $this
     */
    public function setRemittance($remittance)
    {
        $this->data['наложенный_платеж'] = ($remittance ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Устанавливает флаг "с доставкой на дом"
     *
     * @param bool $withDelivery Флаг "с доставкой на дом"
     *
     * @return $this
     */
    public function setWithDelivery($withDelivery)
    {
        $this->data['с_доставкой_на_дом'] = ($withDelivery ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Устанавливает флаг "C уведомлением"
     *
     * @param bool $withNotification Флаг "с уведомлением"
     *
     * @return $this
     */
    public function setWithNotification($withNotification)
    {
        $this->data['с_уведомлением'] = ($withNotification ? 'Yes' : 'Off');

        return $this;
    }

    /**
     * Устанавливает ФИО получателя платежа
     *
     * @param string $name ФИО получателя платежа
     *
     * @return $this
     */
    public function setToName($name)
    {
        $this->data['кому'] = $name;

        return $this;
    }

    /**
     * Устанавливает адрес получателя перевода (без индекса)
     *
     * @param string $address Адрес получателя перевода (без индекса)
     *
     * @return $this
     */
    public function setToAddress($address)
    {
        $this->data['куда'] = $address;

        return $this;
    }

    /**
     * Устанавливает индекс получателя перевода
     *
     * @param string $code Индекс получателя перевода
     *
     * @return $this
     */
    public function setToAddressPostalCode($code)
    {
        $this->data['индекс_куда'] = $code;

        return $this;
    }

    /**
     * Устаналивает ИНН (для получения платежа на банковский счет)
     *
     * @param string $inn ИНН (для получения платежа на банковский счет)
     *
     * @return $this
     */
    public function setInn($inn)
    {

    }

    /**
     * Устанавливает кореспондентский счёт (для получения платежа на банковский счет)
     *
     * @param string $account Кореспондентский счёт (для получения платежа на банковский счет)
     *
     * @return $this
     */
    public function setCorrespondentAccount($account)
    {

    }

    /**
     * Устанавливает наименование банка (для получения платежа на банковский счет)
     *
     * @param string $name Наименование банка (для получения платежа на банковский счет)
     *
     * @return $this
     */
    public function setBankName($name)
    {

    }

    /**
     * Устанавливает расчётный счёт (для получения платежа на банковский счет)
     *
     * @param string $account Расчётный счёт (для получения платежа на банковский счет)
     *
     * @return $this
     */
    public function setAccount($account)
    {

    }

    /**
     * Устанавливает БИК (для получения платежа на банковский счет)
     *
     * @param string $account БИК (для получения платежа на банковский счет)
     *
     * @return $this
     */
    public function setBik($bik)
    {

    }

    /**
     * Устанавливает адрес отправителя платежа (без индекса)
     *
     * @param string $address Адрес отправителя платежа (без индекса)
     *
     * @return $this
     */
    public function setFromAddress($address)
    {
        $this->data['адрес_отправителя'] = $address;

        return $this;
    }

    /**
     * Устанавливает индекс отправителя платежа
     *
     * @param string $code Индекс отправителя платежа
     *
     * @return $this
     */
    public function setFromAddressPostalCode($code)
    {
        $this->data['индекс_адреса_отправителя'] = $code;

        return $this;
    }

    /**
     * Устанавливает ФИО отправителя платежа
     *
     * @param string $name ФИО отправителя платежа
     *
     * @return $this
     */
    public function setFromName($name)
    {
        $this->data['от_кого'] = $name;

        return $this;
    }
}