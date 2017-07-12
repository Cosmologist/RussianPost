<?php

namespace Cosmologist\RussianPost\Form;

use mikehaertl\pdftk\Pdf;

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