<?php
class Post {
    private static $latestId = 0; // Variable statique pour stocker l'ID le plus récent
    private $id;
    private $content;
    private $author;
    private $createdAt;

    public function __construct($content, $author, $createdAt) {
        $this->id = ++self::$latestId; // Incrémente l'ID à chaque nouvelle instance
      
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
    }

    // Getters and Setters for the properties

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }
}
?>