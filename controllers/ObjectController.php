<?php
require_once "BaseAreaTwigController.php";

class ObjectController extends BaseAreaTwigController{
    public $template="object.twig";
    public function getContext() : array {
        $context=parent::getContext();

        $query=$this->pdo->prepare("SELECT description, id FROM vasteras_area WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data=$query->fetch();
        $context['description']=$data['description'];
        $context['url_title'] = "vasteras-area/" . $data['id'];

        return $context;
    }
}