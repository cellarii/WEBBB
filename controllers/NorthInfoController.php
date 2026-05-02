<?php

class NorthInfoController extends NorthController {
    public $template = "north_info.twig";

    public function getContext() : array {
        $context = parent::getContext();
        $context["is_info"] = true;
        return $context;
    }
}