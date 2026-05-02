<?php
require_once "TwigBaseController.php";

class MainController extends TwigBaseController {
    public $title = "Главная";
    public $template = "main.twig";
    public function getContext() : array {
        $context = parent::getContext();
        $context["menu_items"] = [
            [
                "title" => "Север",
                "url_title" => "north"
            ],
            [
                "title" => "Юг",
                "url_title" => "south"
            ]
        ];

        $query = $this->pdo->query("SELECT * FROM vasteras_area");
        $context['vasteras_area'] = $query->fetchAll();

        return $context;
    }
}