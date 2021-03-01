<?php

use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$student1 = new Student(null, 'Sandra Renata Daiane Martins', new DateTimeImmutable('1948-08-20'));
$student2 = new Student(1, 'Werner Luiz Gottschalt',  new DateTimeImmutable('1992-05-01'));

$studentRepo = new PdoStudentRepository();

// if ($studentRepo->save($student1)) {
//     echo "Aluno Cadastrado com sucesso! <br>";
// }

if ($studentRepo->save($student2)) {
    echo "Aluno Atualizado com sucesso! <br>";
};
