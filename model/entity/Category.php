<?php

namespace Model\Entity;

use App\AbstractEntity;

class Category extends AbstractEntity
{
    private $id;
    private $name;


    public function __construct($data){
        parent::hydrate($data, $this);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @returnself
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @returnself
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

?>