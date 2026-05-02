<?php

require_once "SouthController.php";

class SouthInfoController extends SouthController {
    public $template = "south_info.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context["is_info"] = true;
        return $context;
    }
}