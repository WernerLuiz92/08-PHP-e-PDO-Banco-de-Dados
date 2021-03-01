<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$studentRepo = new PdoStudentRepository();

$student = new Student(10, 'Sandra Renata Daiane Martins', new DateTimeImmutable('1948-08-20'));

if ($studentRepo->remove($student)) {
    echo "Aluno excluído com sucesso!";
}
