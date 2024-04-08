<?php

class Post
{
    private $id;
    private $content;
    private $author;
    private $createdAt;

    public function __construct($content, $author, $createdAt, $id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
    }



    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function displayPost()
    {
        require("../model/database.php");
        global $db;
        echo "<div class='post'>";
        $query = $db->prepare("SELECT * FROM user WHERE id=?");
        $query->execute([$this->author]);
        $data = $query->fetch();
        if ($data) {
            echo "<a class='hello' id='nav-link' href='../view/user.php?id=" . $this->author . "'>";
            echo "<p class='author'>" . $data["pseudo"] . "</p>";
            echo "</a>";
        } else {
            echo "<p class='author'>Unknown</p>";
        }

        echo "<p class='content'>$this->content</p>";
        echo "<p class='createdAt'>$this->createdAt</p>";
        echo "</div>";
    }
}
