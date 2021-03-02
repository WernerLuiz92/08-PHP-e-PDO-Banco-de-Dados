<?php

namespace Werner\Pdo\Infrastructure\Persistence;

use PDO;
use PDOException;

class DatabaseConnection
{
    public static function createConnection(): PDO
    {

        /** Conexão SQLite */

        // $databasePath = __DIR__ . '/../../../dataBase.sqlite';

        // $connection = new PDO('sqlite:' . $databasePath);
        // $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // $databasePath = __DIR__ . '/../../../dataBase.sqlite';


        /** Conexão MySQL Docker */

        $dsn = 'mysql:dbname=PHP_PDO;host=172.18.0.10';
        $user = 'root';
        $password = 'mysql';

        try {
            $connection = new PDO($dsn, $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $connection;
    }
}
