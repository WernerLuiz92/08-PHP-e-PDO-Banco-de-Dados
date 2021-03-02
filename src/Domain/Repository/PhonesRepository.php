<?php

namespace Werner\Pdo\Domain\Repository;

use Werner\Pdo\Domain\Model\Phone;

interface PhoneRepository
{
    public function save(string $name, Phone $phone): bool;
    public function remove(string $name, Phone $phone): bool;
}
