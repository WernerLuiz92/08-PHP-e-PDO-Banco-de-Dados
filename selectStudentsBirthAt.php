<?php

use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$studentRepo = new PdoStudentRepository;

$birthDate = new DateTimeImmutable('1992-05-01');

$studentsList = $studentRepo->studentsBirthAt($birthDate);

foreach ($studentsList as $student) {
    echo "ID: {$student->getId()} <br>";
    echo "Nome: {$student->getName()} <br>";
    echo "Data de Nascimento: {$student->getBirthDate()->format('d/m/Y')} <br>";
    echo "Idade: {$student->getAge()} <br>";
    echo "<br>";
}
