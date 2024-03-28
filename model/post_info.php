<?php
class Post {
    private $id;
    private $content;
    private $author;
    private $createdAt;

    public function __construct($content, $author, $createdAt,$id) {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
    }



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
    public function displayPost() {
        echo "<div class='post'>";
        echo "<p class='content'>$this->content</p>";
        echo "<p class='createdAt'>$this->createdAt</p>";
        echo "</div>";
    }
}
?>