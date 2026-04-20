<?php
// conexion.php

// 1. Punto de conexión de Azure
$host = 'abejago-db.mysql.database.azure.com'; 

// 2. Nombre de tu base de datos en Azure
$dbname = 'abejago'; 

// 3. Inicio de sesión del administrador
$user = 'axelqs'; 

// 4. Tu contraseña de Azure (¡Reemplaza este texto con tu contraseña real!)
$pass = 'pDFB1u9L'; 

try {
    // Mantenemos utf8mb4 para que los emojis de las recompensas y el texto funcionen perfecto
    // Además, Azure Database for MySQL requiere que especifiquemos que nos conectamos al puerto 3306 (por defecto)
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Configurar PDO para que lance excepciones cuando haya errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // NOTA SOBRE SSL: Azure suele requerir conexiones cifradas obligatoriamente. 
    // Si al probar la conexión te arroja un error relacionado con SSL, 
    // tendrás que descargar el certificado de Azure y descomentar esta línea:
    // $pdo->setAttribute(PDO::MYSQL_ATTR_SSL_CA, __DIR__ . '/DigiCertGlobalRootCA.crt.pem');
    
    // echo "¡Conexión exitosa a Azure!"; // Descomenta esto solo para probar y luego bórralo
    
} catch (PDOException $e) {
    die("Error de conexión a la base de datos en la nube: " . $e->getMessage());
}
?>