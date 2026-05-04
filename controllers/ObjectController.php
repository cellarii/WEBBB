<?php
require_once "BaseAreaTwigController.php";

class ObjectController extends BaseAreaTwigController{
    public $template="object.twig";
    public function getContext() : array {
        $context=parent::getContext();

        $query=$this->pdo->prepare("SELECT description, image, info, id FROM vasteras_area WHERE id = :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data=$query->fetch();
        $context['description']=$data['description'];
        $context['url_title'] = "vasteras-area/" . $data['id'];

        $show=$_GET['show'] ?? '';

        if ($show=='image'){
            $context['is_image']=true;
            $context['is_info']=false;
            $context['image']=$data['image'];
        } else if ($show=='info'){
            $context['is_info']=true;
            $context['is_image']=false;
            $context['info']=$data['info'];
        } else {
            $context['is_image']=false;
            $context['is_info']=false;
        }

        return $context;
    }
}