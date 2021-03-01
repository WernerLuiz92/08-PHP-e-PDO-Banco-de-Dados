<?php

use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$studentRepo = new PdoStudentRepository;

$name = "Werner Luiz Gottschalt";

$studentsList = $studentRepo->oneStudent($name);

foreach ($studentsList as $student) {
    echo "ID: {$student->getId()} <br>";
    echo "Nome: {$student->getName()} <br>";
    echo "Data de Nascimento: {$student->getBirthDate()->format('d/m/Y')} <br>";
    echo "Idade: {$student->getAge()} <br>";
    echo "<br>";
}
