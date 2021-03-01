<?php

use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;

$pdo = DatabaseConnection::CreateConnection();

echo "Connection successful!";

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');
