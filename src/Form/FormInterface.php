<?php

namespace Cosmologist\RussianPost\Form;

/**
 * Интерфейс для форм
 */
interface FormInterface
{
    /**
     * Сохранение заполненной формы
     *
     * @return string Путь к файлу с результатом
     */
    public function generate();
}