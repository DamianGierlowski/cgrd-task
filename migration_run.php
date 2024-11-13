<?php
$host = getenv('DB_HOST');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');

$dsn = "mysql:host=$host;dbname=$db";

$pdo = new PDO($dsn, $user, $password);

foreach (glob(__DIR__ . '/migrations/*.sql') as $file) {
    $sql = file_get_contents($file);
    $pdo->exec($sql);
    echo "Migration applied: " . basename($file) . "\n";
}