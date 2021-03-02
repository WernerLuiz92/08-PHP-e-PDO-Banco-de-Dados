<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::CreateConnection();

$studentRepository = new PdoStudentRepository($pdo);

$studentsList = $studentRepository->allStudents();

$alunosParaExcluir = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];

foreach ($studentsList as $student) {
    if (in_array($student->getId(), $alunosParaExcluir, true)) {
        if ($studentRepository->remove($student)) {
            echo "Aluno excluído com sucesso!";
        }
    }
}
