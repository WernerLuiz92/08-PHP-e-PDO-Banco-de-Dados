<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = DatabaseConnection::createConnection();
$studentRepository = new PdoStudentRepository($connection);


$connection->beginTransaction();

try {
    $aluno1 = new Student(
        null,
        'Nico Steppat',
        new DateTimeImmutable('1985-05-01')
    );
    $studentRepository->save($aluno1);

    $aluno2 = new Student(
        null,
        'Sérgio Elias Viana',
        new DateTimeImmutable('1949-11-01')
    );
    $studentRepository->save($aluno2);

    $aluno3 = new Student(
        null,
        'Bruna Rayssa Lima',
        new DateTimeImmutable('1992-03-12')
    );
    $studentRepository->save($aluno3);

    $aluno4 = new Student(
        null,
        'Brenda Elaine Araújo',
        new DateTimeImmutable('1997-08-24')
    );
    $studentRepository->save($aluno4);

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
