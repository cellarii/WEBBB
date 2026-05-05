<?php
require_once "BaseAreaTwigController.php";

class TypeCreateController extends BaseAreaTwigController{
    public $template="type_create.twig";
    public function get(array $context)
    {
        echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context);
    }

    public function post(array $context){    
        $type_name=$_POST['name'];

        $tmp_name=$_FILES['image']['tmp_name'];
        $name=$_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url="/media/$name";

        $sql = <<<EOL
INSERT INTO area_type(name, image)
VALUES(:name, :image_url)
EOL;

        $query=$this->pdo->prepare($sql);
        $query->bindValue("name", $type_name);
        $query->bindValue("image_url", $image_url);
        $query->execute();

        $context['message']="Вы успешно создали новый тип";
        $context['id'] = $this->pdo->lastInsertId();
        $this->get($context);
    }
}