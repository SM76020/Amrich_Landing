<?php
$host = "sql108.infinityfree.com";
$dbname = "if0_34626547_project_mgmt";
$username = "if0_34626547"; // Change as needed
$password = "YYhqfVxSvoYjP";     // Change as needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
?>
