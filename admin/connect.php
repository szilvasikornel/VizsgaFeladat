<?php  

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

header('Content-Type: text/html; charset=utf-8');

//Az adatbázis kapcsolathoz szükséges adatok definiálása
define('DBHOST', $_ENV['DBHOST']);
define('DBUSER', $_ENV['DBUSER']);
define('DBPASS', $_ENV['DBPASS']);
define('DBNAME', $_ENV['DBNAME']);

//adatbázis kapcsolat létrehozása, és esetleg hibakezelés
$conn = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Hiba az adatbázis kapcsolatban: " . mysqli_connect_error());

// karakterkódolás beállítása az adatbázis kapcsolaton keresztül
mysqli_query($conn, "SET NAMES utf8");
