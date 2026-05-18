<?php
require_once "BaseController.php";
class TwigBaseController extends BaseController {
    public $title = "";
    public $template = "";
    public \Twig\Environment $twig;

    public function setTwig($twig){
        $this->twig=$twig;
    }

    public function getContext() : array {
        $context = parent::getContext();
        $context["title"] = $this->title;

        $current_url = urldecode($_SERVER['REQUEST_URI']);
        
        if (!isset($_SESSION['visited_urls'])) {
            $_SESSION['visited_urls'] = [];
        }
        
        $last_url = end($_SESSION['visited_urls']);
        if ($current_url != $last_url) {
            array_push($_SESSION['visited_urls'], $current_url);
        }
        
        if (count($_SESSION['visited_urls']) > 10) {
            array_shift($_SESSION['visited_urls']);
        }

        return $context;
    }

    public function get(array $context) {
        echo $this->twig->render($this->template, $context);
    }
}