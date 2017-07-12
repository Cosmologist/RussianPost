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
     * @param string $path Путь, куда сохранить файл
     *
     * @return bool Результат сохранения
     */
    public function save($path);
}