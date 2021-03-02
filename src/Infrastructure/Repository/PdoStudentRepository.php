<?php

namespace Werner\Pdo\Infrastructure\Repository;

use DateTimeImmutable;
use PDO;
use PDOStatement;
use Werner\Pdo\Domain\Model\Phone;
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
        $sqlQuery = 'SELECT * FROM students;';
        $statement = $this->connection->query($sqlQuery);

        return $this->hydrateStudentList($statement);
    }

    public function studentsWithPhones(): array
    {
        $sqlQuery = 'SELECT students.id,
                            students.name,
                            students.birth_date,
                            phones.id AS phone_id,
                            phones.area_code,
                            phones.number 
                     FROM students
                     JOIN phones ON students.id = phones.student_id;';

        $statement = $this->connection->query($sqlQuery);

        $result = $statement->fetchAll();
        $studentList = [];

        foreach ($result as $row) {
            if (!array_key_exists($row['id'], $studentList)) {
                $studentList[$row['id']] = new Student($row['id'], $row['name'], new DateTimeImmutable($row['birth_date']));
            }
            $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
    }

    public function oneStudent($name): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE name = :name;';
        $statement = $this->connection->query($sqlQuery);

        $statement->execute([
            ':name' => $name
        ]);

        return $this->hydrateStudentList($statement);
    }

    public function studentsByName($name): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE name LIKE :name;';
        $statement = $this->connection->query($sqlQuery);

        $bind = '%' . $name . '%';

        $statement->execute([
            ':name' => $bind
        ]);

        return $this->hydrateStudentList($statement);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date = :birth_date;';
        $statement = $this->connection->prepare($sqlQuery);
        $statement->execute([
            ':birth_date' => $birthDate->format('Y-m-d')
        ]);

        return $this->hydrateStudentList($statement);
    }

    private function hydrateStudentList(PDOStatement $statement): array
    {
        $studentDataList = $statement->fetchAll();
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
        $sqlQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);';
        $statement = $this->connection->prepare($sqlQuery);

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
        $sqlQuery = 'UPDATE students SET name = :name WHERE id = :id;';
        $statement = $this->connection->prepare($sqlQuery);

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
