<?php

use Werner\Pdo\Domain\Model\Phone;
use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = DatabaseConnection::createConnection();

$studentRepository = new PdoStudentRepository($connection);

$connection->beginTransaction();

try {

    $studentsPhones = [
        'Sandra Renata Daiane Martins' => [
            new Phone(null, '55', '9-9985-2646'),
            new Phone(null, '54', '3332-5616')
        ],
        'Mariana Renata Moura' => [
            new Phone(null, '55', '9-9186-5616'),
            new Phone(null, '55', '3331-7075')
        ],
        'Vicente Bruno Rafael Bernardes' => [
            new Phone(null, '54', '9-9116-3246'),
            new Phone(null, '54', '9-8415-4545'),
            new Phone(null, '54', '3333-5055')
        ],
        'Pedro Henrique Enzo Enrico Vieira' => [
            new Phone(null, '55', '9-9123-8989'),
            new Phone(null, '55', '9-9989-5687')
        ],
        'Pedro Geraldo Joaquim Aparício' => [
            new Phone(null, '55', '9-9989-5687'),
            new Phone(null, '55', '9-9180-8121')
        ]
    ];

    foreach ($studentsPhones as $name => $phones) {
    }

    $connection->commit();

    $studentsList = $studentRepository->allStudents();

    foreach ($studentsList as $student) {
        echo "ID: {$student->getId()} <br>";
        echo "Nome: {$student->getName()} <br>";
        echo "Data de Nascimento: {$student->getBirthDate()->format('d/m/Y')} <br>";
        echo "Idade: {$student->getAge()} <br>";
        echo "<br>";
    }
} catch (PDOException $err) {
    echo $err->getMessage();
    $connection->rollBack();
}
