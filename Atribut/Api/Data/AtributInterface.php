<?php

namespace Pasha\Atribut\Api\Data;

interface AtributInterface
{
    const SECOND_MAIL = 'second_mail';

    public function getSecondMail();
    public function setSecondMail($second_mail);
}
