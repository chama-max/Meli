<?php
// conn.php - PDO connection using environment variables (works for Render + external MySQL)
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_NAME') ?: 'meli_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

// Use 127.0.0.1 to force TCP (avoid unix socket issues)
$dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $conn = new PDO($dsn, $user, $pass, $options);
    // optional: $conn->exec("SET time_zone = '+00:00'"); 
} catch (PDOException $e) {
    // Show readable message in logs — don't expose secrets to public.
    error_log("DB Connection failed: " . $e->getMessage());
    // For development only: show minimal error
    die("Database connection error. Please check server logs.");
}
