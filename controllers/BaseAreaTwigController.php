<?php

class BaseAreaTwigController extends TwigBaseController{
    #[Override]
    public function getContext(): array
    {
        $context=parent::getContext();
        $query=$this->pdo->query("SELECT DISTINCT type FROM vasteras_area ORDER BY 1");
        $types=$query->fetchAll();
        $context['types']=$types;
        return $context;
    }
}