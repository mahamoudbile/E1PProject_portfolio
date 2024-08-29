<?php 
require_once __DIR__. '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$serverName = $_ENV['DB_HOST'];
$userName = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];



$conn = new mysqli($serverName, $userName, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $serverName = "localhost";
// $userName = "root";
// $password = "";
// $dbName = "portfolio_p_e1";

// $conn = new mysqli($serverName, $userName, $password, $dbName);
?>