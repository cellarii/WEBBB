<?php

class SearchController extends BaseAreaTwigController{
    public $template="search.twig";
    
    #[Override]
    public function getContext(): array
    {
        $context=parent::getContext();

        $type=isset($_GET['type']) ? $_GET['type'] : '';
        $title=isset($_GET['title']) ? $_GET['title'] : '';

        $context['type'] = $type;
        $context['title'] = $title;

        $sql = <<< EOL
        SELECT id, title FROM vasteras_area
        WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
        EOL;

        $query=$this->pdo->prepare($sql);
        $query->bindValue('title', $title);
        $query->execute();
        $context['objects']=$query->fetchAll();

        return $context;
    }
}