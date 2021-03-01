<?php

use Werner\Pdo\Infrastructure\Persistence\DatabaseConnection;
use Werner\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = DatabaseConnection::createConnection();
$studentRepository = new PdoStudentRepository($connection);
