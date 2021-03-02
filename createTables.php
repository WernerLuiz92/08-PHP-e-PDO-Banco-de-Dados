<?php

require_once 'vendor/autoload.php';

use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;

$connection = DatabaseConnection::createConnection();

$createTablesQuery = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY(student_id) REFERENCES students(id)
    );
';

try {
    $connection->exec($createTablesQuery);
    echo "Tabelas criadas com sucesso!";
} catch (PDOException $err) {
    echo $err->getMessage();
    $connection->rollBack();
}
