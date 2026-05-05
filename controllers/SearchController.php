<?php

require_once "BaseAreaTwigController.php";

class SearchController extends BaseAreaTwigController {
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $description = isset($_GET['description']) ? $_GET['description'] : '';

        $context['type'] = $type;
        $context['title'] = $title;
        $context['description'] = $description;

        if ($title !== '' || $description !== '') {
            $sql = <<<EOL
SELECT id, title
FROM vasteras_area
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
AND (:description = '' OR info LIKE CONCAT('%', :description, '%'))
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
        } else {
            $sql = <<<EOL
SELECT id, title
FROM vasteras_area
WHERE type = :type
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("type", $type);
        }

        $query->execute();
        $context['objects'] = $query->fetchAll();

        return $context;
    }
}