<?php
$host = getenv('PG_HOST');
$port = getenv('PG_PORT');
$dbname = getenv('PG_DATABASE');
$user = getenv('PG_USER');
$password = getenv('PG_PASSWORD');

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Conexão falhou: " . pg_last_error());
}
?>
