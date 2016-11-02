<?php

namespace Cosmologist\RussianPost;

use mikehaertl\pdftk\Pdf;

/**
 * Fill the remittance form (112EP)
 */
class RemittanceFiller
{
    /**
     * Fields map for PDF-form
     *
     * @var array
     */
    protected $fields = [
        'amountRubles' => 'руб',
        'amountKopeks' => 'коп'
    ];

    /**
     * Constructor
     *
     */
    public function __construct($blank)
    {
        $this->pdf = new Pdf($blank);
    }

    public function setAmount($amount)
    {
        $this->pdf->fillForm([
            $this->fields['amountRubles'] => (int) $amount,
            $this->fields['amountKopeks'] => (int) ($amount - floor($amount))*100,

        ]);
    }

    public function save($path)
    {
        return $this->pdf->saveAs($path);
    }
}