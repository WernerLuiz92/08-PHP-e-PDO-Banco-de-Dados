<?php

$dbPath = __DIR__ . '/dataBase.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

echo "Connection successful!";