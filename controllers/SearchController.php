<?php
require_once "BaseAreaTwigController.php";

class SearchController extends BaseAreaTwigController{
    public $template="search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $type=isset($_GET['type']) ? $_GET['type'] : '';
        $title=isset($_GET['title']) ? $_GET['title'] : '';
        $full_description=isset($_GET['full_description']) ? $_GET['full_description'] : '';
        $sql = <<<EOL
SELECT id, title
FROM vasteras_area
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
    and ((type = :type) OR :type='все')
    and (:full_description='' OR info like CONCAT('%', :full_description, '%'))
EOL;
    $query=$this->pdo->prepare($sql);
    $query->bindValue("title", $title);
    $query->bindValue("type", $type);
    $query->bindValue("full_description",$full_description);
    $query->execute();
    
    $context['objects']=$query->fetchAll();
    $context['selected_type']=$type; 
    $context['title']=$title;
    $context['full_description']=$full_description;
    return $context;
    }
}