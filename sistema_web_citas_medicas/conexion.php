
<?php

$host = "localhost";
$bd = "citas_db";
$usuario = "root";
$contrasena = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("No se pudo conectar con la base de datos.");
}

