<?php

namespace Werner\Pdo\Infrastructure\Persistence;

use PDO;

class DatabaseConnection
{
    public static function CreateConnection(): PDO
    {
        $databasePath = __DIR__ . '/../../../dataBase.sqlite';

        return new PDO('sqlite:' . $databasePath);
    }
}
