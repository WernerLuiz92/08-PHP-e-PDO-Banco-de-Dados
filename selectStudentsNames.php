<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::CreateConnection();

$statement = $pdo->query("SELECT * FROM students;");

while ($student = $statement->fetchColumn(1)) {
    echo "Olá {$student}! <br>";
}
