<?php

require_once "SouthController.php";

class SouthImageController extends SouthController {
    public $template = "object_image.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context["is_image"] = true;
        $context["url_image"] = "/images/south_landscape.jpg";
        return $context;
    }
}