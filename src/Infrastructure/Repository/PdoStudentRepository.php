<?php

namespace Werner\Pdo\Infrastructure\Repository;

use DateTimeImmutable;
use PDO;
use PDOStatement;
use Werner\Pdo\Domain\Model\Student;
use Werner\Pdo\Domain\Repository\StudentRepository;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $PDOconnection)
    {
        $this->connection = $PDOconnection;
    }

    public function allStudents(): array
    {
        $selectAllQuery = 'SELECT * FROM students;';
        $statement = $this->connection->query($selectAllQuery);

        return $this->hydrateStudentList($statement);
    }

    public function oneStudent($name): array
    {
        $selectAllQuery = 'SELECT * FROM students WHERE name = :name;';
        $statement = $this->connection->query($selectAllQuery);

        $statement->execute([
            ':name' => $name
        ]);

        return $this->hydrateStudentList($statement);
    }

    public function studentsByName($name): array
    {
        $selectAllQuery = 'SELECT * FROM students WHERE name LIKE :name;';
        $statement = $this->connection->query($selectAllQuery);

        $bind = '%' . $name . '%';

        $statement->execute([
            ':name' => $bind
        ]);

        return $this->hydrateStudentList($statement);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $selectByDateQuery = 'SELECT * FROM students WHERE birth_date = :birth_date;';
        $statement = $this->connection->prepare($selectByDateQuery);
        $statement->execute([
            ':birth_date' => $birthDate->format('Y-m-d')
        ]);

        return $this->hydrateStudentList($statement);
    }

    private function hydrateStudentList(PDOStatement $statement): array
    {
        $studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {
        if ($student->getId() === null) {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);';
        $statement = $this->connection->prepare($insertQuery);

        $success = $statement->execute([
            ':name' => $student->getName(),
            ':birth_date' => $student->getBirthDate()->format('Y-m-d')
        ]);

        if ($success) {
            $student->setId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name WHERE id = :id;';
        $statement = $this->connection->prepare($updateQuery);

        $success = $statement->execute([
            ':name' => $student->getName(),
            ':id' => $student->getId()
        ]);

        return $success;
    }

    public function remove(Student $student): bool
    {

        $statement = $this->connection->prepare('DELETE FROM students WHERE id = ?;');
        $statement->bindValue(1, $student->getId(), PDO::PARAM_INT);

        return $statement->execute();
    }
}
