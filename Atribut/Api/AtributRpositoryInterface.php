<?php

namespace Pasha\Atribut\Api;

interface AtributRpositoryInterface
{
    public function getById($id);

    public function save(AdminLogInterface $save);
}
