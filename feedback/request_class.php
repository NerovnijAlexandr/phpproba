<?php

class FormData
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function clear($str)
    {
        return strip_tags( trim($str) );
    }

    public function getField($inputName)
    {
        $value = $_POST[$inputName] ?? '';

        return $this->clear($value);
    }
}

class Request extends FormData
{
    private $errors = [];

    public function required($inputName)
    {
        $value = $this->getField($inputName);
        if(empty($value))
        {
            $this->errors[$inputName][] = 'поле обязательно к заполнению';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * проверяет длину строки из поля на минимальное значения
     * @param $inputName
     * @param $min
     */
    public function min($inputName, $min)
    {
        $value = $this->getField($inputName);
        if(mb_strlen($value) < $min)
        {
            $this->errors[$inputName][] = "минимальная длина поля ".$min." символов";
        }
    }


    /**
     * проверяет длину строки из поля на максимальное значения
     * @param $inputName
     * @param $max
     */
    public function max($inputName, $max)
    {
        $value = $this->getField($inputName);
        if(mb_strlen($value) > $max)
        {
            $this->errors[$inputName][] = "максимальная длина поля ".$max." символов";
        }
    }

    /**
     * проверка значения на максимальность
     * метод проверяет является ли введенное значение email
     * @param $inputName - имя поля
     */
    public function isEmail($inputName)
    {
        $value = $this->getField($inputName);
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$inputName][] = "невалидный адрес email";
        }
    }

    /**
     * проверка значения на максимальность
     * @param $inputName
     * @param $minValue
     */
    public function maxValue($inputName, $maxValue)
    {
        $value = $this->getField($inputName);
        if($value > $maxValue) {
            $this->errors[$inputName][] = "максимальное значение поля ".$maxValue;
        }
    }

    /**
     * проверка значения на минимальность
     * @param $inputName
     * @param $minValue
     */
    public function minValue($inputName, $minValue)
    {
        $value = $this->getField($inputName);
        if($value < $minValue) {
            $this->errors[$inputName][] = "миниинимальное значение поля ".$minValue;
        }
    }

    /**
     * проверка на число
     * @param $inputName
     */
    public function isNumeric($inputName)
    {
        $value = $this->getField($inputName);
        if(!is_numeric($value)) {
            $this->errors[$inputName][] = "значение должно быть числом";
        }
    }

    /**
     * прверяет на соответствие с выбранным значением
     * @param $inputName
     * @param $curValue
     */
    public function isValue($inputName, $curValue) {
        $value = $this->getField($inputName);
        if($curValue && $value === $curValue)
        {
            $this->errors[$inputName][] = 'Такое значение уже существует';
        }
    }

    /**
     * проверка на соответствие password1 и password2
     * @param $inputName
     * @param $curValue
     */
    public function eqPassword($inputName, $curValue) {
        $value = $this->getField($inputName);
        if($curValue && $value !== $curValue)
        {
            $this->errors[$inputName][] = 'Пароли должны совпадать';
        }
    }
}

?>