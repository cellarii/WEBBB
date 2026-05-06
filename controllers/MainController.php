<?php

require_once "BaseAreaTwigController.php";

class MainController extends BaseAreaTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    
    public function getContext() : array
    {
        $context = parent::getContext(); 
        
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $sql = <<<EOL
SELECT vasteras_area.*, area_type.name
FROM vasteras_area 
JOIN area_type ON vasteras_area.type_id = area_type.id 
WHERE area_type.name = :type
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $sql = <<<EOL
SELECT vasteras_area.*, area_type.name
FROM vasteras_area 
LEFT JOIN area_type ON vasteras_area.type_id = area_type.id
EOL;
            $query = $this->pdo->query($sql);
        }
        
        $context['vasteras_area'] = $query->fetchAll();
        return $context;
    }
}