<?php
$conn = pg_connect("host=localhost port=5433 dbname=postgres user=postgress password=12345");

if (!$conn) {
    die("Conexão falhou: " . pg_last_error());
} 
?>
