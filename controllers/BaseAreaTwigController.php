<?php

class BaseAreaTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("SELECT id, name FROM area_type");
        $types = $query->fetchAll();
        $context['types'] = $types;
        
        $context['visited_urls'] = isset($_SESSION['visited_urls']) ? array_reverse($_SESSION['visited_urls']) : [];
        $context['my_session_message'] = $_SESSION['welcome_message'] ?? '';
        
        return $context;
    }
}