<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$student = new Student(null, "Helena Liz Isabelle Rocha", new \DateTimeImmutable('1964-05-16'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if (!$statement->execute()) {
    echo "Erro ao cadastrar aluno";
    exit();
}
echo "Aluno cadastrado com sucesso!";
