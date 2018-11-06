<?php

namespace Cosmologist\RussianPost\Form;

use mikehaertl\pdftk\Pdf;
use RuntimeException;

/**
 * Абстрактная форма
 */
abstract class AbstractForm implements FormInterface
{
    /**
     * Данные формы
     *
     * @var array
     */
    protected $data = [];

    /**
     * Обертка вокруг pdftk
     *
     * @var Pdf
     */
    protected $pdf;

    /**
     * Конструктор
     *
     * @param string $pdfFormPath Путь в файлу с формой
     */
    public function __construct($pdfFormPath)
    {
        $this->pdf = new Pdf($pdfFormPath);
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $result = $this->pdf->fillForm($this->data)->execute();
        if ($result === false) {
            throw new RuntimeException($this->pdf->getError());
        }

        return $this->pdf->getTmpFile()->getFileName();
    }
}