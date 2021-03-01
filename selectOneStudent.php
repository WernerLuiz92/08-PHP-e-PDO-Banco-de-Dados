<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);


//** Trás um único estudante com o id = 1 através do WHERE */
$statement = $pdo->query("SELECT * FROM students WHERE id = 1;");

$studentData = $statement->fetch(PDO::FETCH_ASSOC);

$student = new Student(
    $studentData['id'],
    $studentData['name'],
    new \DateTimeImmutable(
        $studentData['birth_date']
    )
);

echo "Olá {$student->name()}! A sua idade é de {$student->age()} anos. <br>";


//** Trás todos os estudantes porém um de cada vez usando o fetch */
// $statement = $pdo->query("SELECT * FROM students;");

// while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
//     $student = new Student(
//         $studentData['id'],
//         $studentData['name'],
//         new \DateTimeImmutable(
//             $studentData['birth_date']
//         )
//     );

//     echo "Olá {$student->name()}! A sua idade é de {$student->age()} anos. <br>";
// }
