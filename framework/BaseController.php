<?php
abstract class BaseController {
    public PDO $pdo;
    public array $params;

    public function setParams(array $params){
        $this->params=$params;
    }

    public function setPDO($pdo){
        $this->pdo=$pdo;
    }
    
    public function getContext(): array {
        return [];
    }

    public function process_responce(){
        session_set_cookie_params(10*60*60);
        session_start();
        $method = $_SERVER['REQUEST_METHOD'];
        $context=$this->getContext();
        if ($method=="GET"){
            $this->get($context);
        } elseif ($method=="POST"){
            $this->post($context);
        }
    }

    public function get(array $context) {}
    public function post(array $context) {}
}