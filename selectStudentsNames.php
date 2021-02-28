<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$statement = $pdo->query("SELECT * FROM students;");

while ($student = $statement->fetchColumn(1)) {
    echo "Olá {$student}!". PHP_EOL;
}