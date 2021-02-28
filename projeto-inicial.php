<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$student = new Student(
    null,
    'Werner Luiz Gottschalt',
    new \DateTimeImmutable('1992-05-01')
);

echo $student->age();
