<?php

class BaseAreaTwigController extends TwigBaseController{
    #[Override]
    public function getContext(): array
    {
        $context=parent::getContext();
        $query=$this->pdo->query("SELECT id, name FROM area_type");
        $types=$query->fetchAll();
        $context['types']=$types;
        return $context;
    }
}