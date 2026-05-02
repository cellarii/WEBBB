<?php
require_once "TwigBaseController.php";

class NorthController extends TwigBaseController {
    public $title = "Север";
    public $template = "object.twig";
    public function getContext() : array {
        $context = parent::getContext();
        $context["url_title"] = "north";
        return $context;
    }
}