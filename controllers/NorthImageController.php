<?php
require_once "NorthController.php";

class NorthImageController extends NorthController {
    public $template = "object_image.twig";
    public function getContext() : array {
        $context = parent::getContext();
        $context["url_image"] = "/images/north_landscape.jpg";
        $context["is_image"] = true;
        return $context;
    }
}