<?php
require_once "BaseAreaTwigController.php";

class SearchController extends BaseAreaTwigController{
    public $template="search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $type=isset($_GET['type']) ? $_GET['type'] : '';
        $title=isset($_GET['title']) ? $_GET['title'] : '';
        $description=isset($_GET['description']) ? $_GET['description'] : '';
        $sql = <<<EOL
SELECT id, title
FROM vasteras_area
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    and ((type = :type) OR :type='все')
    and (:description='' OR info like CONCAT('%', :description, '%'))
EOL;
    $query=$this->pdo->prepare($sql);
    $query->bindValue("title", $title);
    $query->bindValue("type", $type);
    $query->bindValue("description",$description);
    $query->execute();
    
    $context['objects']=$query->fetchAll();
    $context['selected_type']=$type; 
    $context['title']=$title;
    $context['description']=$description;
    return $context;
    }
}