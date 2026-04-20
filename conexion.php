<?php
// conexion.php

// 1. Punto de conexión de Azure
$host = 'abejago-db.mysql.database.azure.com'; 

// 2. Nombre de tu base de datos en Azure
$dbname = 'abejago'; 

// 3. Inicio de sesión del administrador
$user = 'axelqs'; 

// 4. Tu contraseña de Azure (¡Pon tu contraseña real aquí!)
$pass = 'pDFB1u9L'; 

try {
    // Aquí está la magia: le decimos a PHP dónde está el certificado que descargaste
    $opciones = [
        PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/DigiCertGlobalRootCA.crt.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Esto evita problemas de validación de host
    ];

    // Ahora pasamos la variable $opciones como cuarto parámetro al crear la conexión PDO
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $pass, $opciones);
    
    // Configurar PDO para que lance excepciones cuando haya errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "¡Conexión segura a Azure establecida!"; // Descomenta esto para celebrar cuando funcione
    
} catch (PDOException $e) {
    die("Error de conexión a la base de datos en la nube: " . $e->getMessage());
}
?>