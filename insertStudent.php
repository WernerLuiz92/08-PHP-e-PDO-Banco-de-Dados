<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$student = new Student(null, "Vinícius Dias", new \DateTimeImmutable('1998-05-14'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?, ?);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1, $student->name());
$statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

if (!$statement->execute()) {
    echo "Erro ao cadastrar aluno";
    exit();
}
echo "Aluno cadastrado com sucesso!";
