<?php
require_once '../vendor/autoload.php';
require_once '../controllers/MainController.php';
require_once '../controllers/NorthController.php';
require_once '../controllers/NorthImageController.php';
require_once '../controllers/NorthInfoController.php';
require_once '../controllers/SouthController.php';
require_once '../controllers/SouthImageController.php';
require_once '../controllers/SouthInfoController.php';
require_once "../controllers/Controller404.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$url = $_SERVER["REQUEST_URI"];

$context = [];
$controller = new Controller404($twig);

$pdo = new PDO("mysql:host=localhost;dbname=vasteras;charset=utf8", "root", "");

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/north/image#", $url)){
    $controller = new NorthImageController($twig);
} elseif (preg_match("#^/north/info#", $url)){
    $controller = new NorthInfoController($twig);
} elseif (preg_match("#^/north#", $url)) {
    $controller = new NorthController($twig);
} elseif (preg_match("#^/south/image#", $url)){
    $controller = new SouthImageController($twig);
} elseif (preg_match("#^/south/info#", $url)){
    $controller = new SouthInfoController($twig);
} elseif (preg_match("#^/south#", $url)) {
    $controller = new SouthController($twig);
}
if ($controller) {
    $controller->setPDO($pdo);
    $controller->get();
}