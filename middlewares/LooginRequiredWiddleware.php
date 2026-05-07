<?php

class LooginRequiredWiddleware extends BaseMiddleware{
    public function apply(BaseController $controller, array $context) {        
        $user = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';
        
        if (empty($user) || empty($password)){
            $this->askPassword();
        }

        $query=$controller->pdo->prepare("SELECT password FROM user WHERE username=:username");
        $query->bindValue("username", $user);
        $query->execute();
        $user_data=$query->fetch();

        $valid_password=$user_data['password'];

        if ($password!=$valid_password){
            $this->askPassword();
        }
    }
    
    private function askPassword() {
        header('WWW-Authenticate: Basic realm="Vasteras Area"');
        http_response_code(401);
        echo 'Доступ запрещён!';
    }
}