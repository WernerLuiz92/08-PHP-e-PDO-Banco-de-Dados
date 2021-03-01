<?php

use Werner\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$idStudent = 6;

$sqlDelete = 'DELETE FROM students WHERE id = :id';
$preparedStatement = $pdo->prepare($sqlDelete);
$preparedStatement->bindValue(':id', $idStudent, PDO::PARAM_INT);

if (!$preparedStatement->execute()) {
    echo "Erro ao excluir aluno";
    exit();
}
echo "Aluno excluido com sucesso!";
