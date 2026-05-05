<?php

class AreaObjectUpdateController extends BaseAreaTwigController
{
    public $template = "edit.twig";
    
    public function get(array $context)
    {
        $id = $this->params['id'];
        $sql = <<<EOL
SELECT * FROM vasteras_area WHERE id = :id
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
        $type = $_POST['type'];
        $info = $_POST['info'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";
        
        $sql = <<<EOL
UPDATE vasteras_area
SET title = :title, description = :description, type = :type, info = :info, image = :image_url
WHERE id = :id
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->bindValue("id", $id);
        $query->execute();
        
        $context['message'] = 'Вы успешно изменили объект!';
        $context['id'] = $id;
        $this->get($context);
    }
}