<?php

require_once "BaseAreaTwigController.php";

class AreaObjectCreateController extends BaseAreaTwigController{
    public $template = "area_object_create.twig";

    public function get(array $context)
    {        
        parent::get($context);
    }

    public function post(array $context){
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $info = $_POST['info'];
        $type_id = $_POST['type_id'];
        
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";
        
        $sql = <<<EOL
INSERT INTO vasteras_area(title, description, type_id, info, image)
VALUES(:title, :description, :type_id, :info, :image_url)
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type_id", $type_id);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->execute();
        
        $context['message'] = "Вы успешно создали новый объект";
        $context['id'] = $this->pdo->lastInsertId();
        $this->get($context);
    }
}