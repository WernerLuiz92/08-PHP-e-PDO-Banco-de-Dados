<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::CreateConnection();

$studentRepo = new PdoStudentRepository($pdo);

$student = new Student(10, 'Sandra Renata Daiane Martins', new DateTimeImmutable('1948-08-20'));

if ($studentRepo->remove($student)) {
    echo "Aluno excluído com sucesso!";
}
