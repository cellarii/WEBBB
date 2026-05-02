<?php

require_once "TwigBaseController.php";

class Controller404 extends TwigBaseController {
    public $title = "Страница не найдена";
    public $template = "404.twig";

    public function get() {
        http_response_code(404);
        parent::get();
    }
}