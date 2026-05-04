<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../controllers/MainController.php';
require_once '../controllers/NorthController.php';
//require_once '../controllers/NorthImageController.php';
//require_once '../controllers/NorthInfoController.php';
require_once '../controllers/SouthController.php';
//require_once '../controllers/SouthImageController.php';
//require_once '../controllers/SouthInfoController.php';
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/ImageController.php";
require_once "../controllers/InfoController.php";
require_once "../controllers/BaseAreaTwigController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$context = [];

$pdo = new PDO("mysql:host=localhost;dbname=vasteras;charset=utf8", "root", "");

$router=new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/north", NorthController::class);
$router->add("/south", SouthController::class);
$router->add("/vasteras-area/(?P<id>\d+)", ObjectController::class);
$router->add("/vasteras-area/(?P<id>\d+)/image", ImageController::class);
$router->add("/vasteras-area/(?P<id>\d+)/info", InfoController::class);

$router->get_or_default(Controller404::class);