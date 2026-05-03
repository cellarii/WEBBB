<?php

class InfoController extends TwigBaseController{
    public $template="object_info.twig";

    public function getContext() : array {
        $context=parent::getContext();

        $query=$this->pdo->prepare("SELECT info, id, description FROM vasteras_area WHERE id= :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data=$query->fetch();
        $context['info']=$data['info'];
        $context['url_title']="vasteras-area/" . $data['id'];
        $context['is_info']=true;
        $context['description']=$data['description'];

        return $context;
    }
}