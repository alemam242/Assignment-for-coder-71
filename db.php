<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "assignment";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch(PDOException $e) {
    $response = [
        "status" => "failed",
        "message" => "Database connection failed!",
        "error" => $e->getMessage()
    ];

    echo json_encode($response);
}
?>
