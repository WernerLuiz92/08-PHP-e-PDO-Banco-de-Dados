<?php

use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = DatabaseConnection::createConnection();

$studentRepo = new PdoStudentRepository($pdo);

$studentsList = $studentRepo->allStudents();

foreach ($studentsList as $student) {
    echo "ID: {$student->getId()} <br>";
    echo "Nome: {$student->getName()} <br>";
    echo "Data de Nascimento: {$student->getBirthDate()->format('d/m/Y')} <br>";
    echo "Idade: {$student->getAge()} <br>";
    echo "Contatos: <br>";
    $phones = $student->getPhones();
    foreach ($phones as $phone) {
        echo "&emsp; Telefone: {$phone->getFormattedPhone()} <br>";
    }
    echo "<br>";
}
