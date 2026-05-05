<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../controllers/MainController.php';
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/BaseAreaTwigController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/AreaObjectCreateController.php";
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/AreaObjectDeleteController.php";

$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$context = [];

$pdo = new PDO("mysql:host=localhost;dbname=vasteras;charset=utf8", "root", "");

$router=new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/vasteras-area/(?P<id>\d+)", ObjectController::class);
//$router->add("/search", SearchController::class);
$router->add("/vasteras-area/create", AreaObjectTwigController::class);
$router->add("/new-type/create", TypeCreateController::class);
$router->add("/vasteras-area/(?P<id>\d+)/delete", AreaObjectDeleteController::class);
$router->get_or_default(Controller404::class);