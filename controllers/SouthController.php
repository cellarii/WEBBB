<?php

require_once "TwigBaseController.php";

class SouthController extends TwigBaseController {
    public $template = "object.twig";
    public $title = "Юг";

    public function getContext() : array {
        $context = parent::getContext();
        $context["url_title"] = "south";
        return $context;
    }
}