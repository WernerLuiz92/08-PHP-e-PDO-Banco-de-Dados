<?php

namespace Werner\Pdo\Infrastructure\Repository;

use DateTimeImmutable;
use PDO;
use PDOStatement;
use Werner\Pdo\Domain\Model\Phone;
use Werner\Pdo\Domain\Repository\PhoneRepository;

class PdoPhoneRepository implements PhoneRepository
{
    public function save(string $name, Phone $phone): bool
    {
        return true;
    }

    public function remove(string $name, Phone $phone): bool
    {
        return true;
    }
}
