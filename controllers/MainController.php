<?php
require_once "BaseAreaTwigController.php";

class MainController extends BaseAreaTwigController {
    public $title = "Главная";
    public $template = "main.twig";
    public function getContext() : array {
        $context = parent::getContext();
        

        if (isset($_GET['type'])){
            $query=$this->pdo->prepare("SELECT * FROM vasteras_area WHERE type=  :type");
            $query->bindValue('type', $_GET['type']);
            $query->execute();
        }
        else {
            $query = $this->pdo->query("SELECT * FROM vasteras_area");
        }

        $context['vasteras_area'] = $query->fetchAll();

        return $context;
    }
}