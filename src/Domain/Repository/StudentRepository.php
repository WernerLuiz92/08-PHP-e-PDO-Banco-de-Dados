<?php

namespace Werner\Pdo\Domain\Repository;

use Werner\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function oneStudent($name): array;
    public function studentsByName($name): array;
    public function studentsBirthAt(\DateTimeInterface $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
