<?php

class AreaObjectUpdateController extends BaseAreaTwigController
{
    public $template = "edit.twig";
    
    public function get(array $context)
    {
        $id = $this->params['id'];
        $sql = <<<EOL
SELECT vasteras_area.*, area_type.name
FROM vasteras_area
LEFT JOIN area_type ON vasteras_area.type_id = area_type.id
WHERE vasteras_area.id = :id
EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();
        $context['object'] = $data;
        
        parent::get($context);
    }

    public function post(array $context)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $id = $this->params['id'];
        $type_id = $_POST['type_id'];
        $info = $_POST['info'];
        
        $tmp_name = $_FILES['image']['tmp_name'] ?? '';
        
        if (empty($tmp_name)) {
            $sql = <<<EOL
UPDATE vasteras_area
SET title = :title, description = :description, type_id = :type_id, info = :info
WHERE id = :id
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type_id", $type_id);
            $query->bindValue("info", $info);
            $query->bindValue("id", $id);
        } else {
            $name = $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
            
            $sql = <<<EOL
UPDATE vasteras_area
SET title = :title, description = :description, type_id = :type_id, info = :info, image = :image_url
WHERE id = :id
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type_id", $type_id);
            $query->bindValue("info", $info);
            $query->bindValue("image_url", $image_url);
            $query->bindValue("id", $id);
        }
        
        $query->execute();
        
        $context['message'] = 'Вы изменили объект';
        $context['id'] = $id;
        $this->get($context);
    }
}