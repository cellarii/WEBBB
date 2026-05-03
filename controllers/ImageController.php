<?php

class ImageController extends TwigBaseController{
    public $template="object_image.twig";
    
    #[Override]
    public function getContext(): array
    {
        $context=parent::getContext();

        $query=$this->pdo->prepare("SELECT image, id, description FROM vasteras_area WHERE id= :my_id");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data=$query->fetch();
        $context['image']=$data['image'];
        $context['url_title']="vasteras-area/" . $data['id'];
        $context['is_image']=true;
        $context['description']=$data['description'];

        return $context;
    }
}