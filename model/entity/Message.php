<?php

namespace Model\Entity;

use App\AbstractEntity;

class Message extends AbstractEntity
{
    private $id;
    private $content;
    private $voteDown;
    private $voteUp;
    private $creationDate;
    private $topic;
    private $user;

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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @returnself
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of voteDown
     */ 
    public function getVoteDown()
    {
        return $this->voteDown;
    }

    /**
     * Set the value of voteDown
     *
     * @returnself
     */ 
    public function setVoteDown($voteDown)
    {
        $this->voteDown = $voteDown;

        return $this;
    }

    /**
     * Get the value of voteUp
     */ 
    public function getVoteUp()
    {
        return $this->voteUp;
    }

    /**
     * Set the value of voteUp
     *
     * @returnself
     */ 
    public function setVoteUp($voteUp)
    {
        $this->voteUp = $voteUp;

        return $this;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getcreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @returnself
     */ 
    public function setcreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @returnself
     */ 
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @returnself
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}

?>