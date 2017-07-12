<?php

namespace Cosmologist\RussianPost;

use RuntimeException;
use Cosmologist\RussianPost\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * "Заполнятель" форм
 */
class Filler
{
    /**
     * Хранилище профилей
     *
     * @var array
     */
    protected $profiles = [];

    /**
     * Добавления профиля для заполнения формы
     *
     * @param string $name Название профиля
     * @param array $data Данные профиля в виде ключ-значение
     *                    Все доступные ключи для каждой формы смотри в README
     */
    public function addProfile($name, $data)
    {
        $this->profiles[$name] = $data;
    }

    /**
     * Заполнение формы данными из профиля
     *
     * @param FormInterface $form Объект формы
     * @param string $profile Имя профиля
     *
     * @return FormInterface Заполненная форма
     */
    public function fill(FormInterface $form, $profile)
    {
        if (!array_key_exists($profile, $this->profiles)) {
            throw new RuntimeException("Profile '$profile' not found");
        }

        $accessor = new PropertyAccessor();

        foreach ($this->profiles[$profile] as $key => $value) {
            $accessor->setValue($form, $key, $value);
        }

        return $form;
    }
}