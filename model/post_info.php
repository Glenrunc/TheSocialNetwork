<?php

class Post
{
    private $id_post;
    private $id_user;
    private $content;
    private $author;
    private $createdAt;
    private $comments;
    // private $like;

    public function __construct($id_post, $content, $author, $createdAt, $id)
    {
        $this->id_post = $id_post;
        $this->id_user = $id;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->comments = array();
        // $this->getLike();
    }


    public function addComment($comment)
    {
        $this->comments[] = array_push($this->comments, $comment);
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getId()
    {
        return $this->id_post;
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
        $query = $db->prepare("SELECT pseudo FROM user WHERE id=?");
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
        $query = $db->prepare("SELECT image FROM post WHERE id=?");
        $query->execute([$this->id_post]);
        $data = $query->fetch();
        var_dump($data); // Add this line for debugging
        if (isset($data["image"])) {
            echo "<img class='img' src='../image/post_photo/" . $data["image"] . "' alt='post image'>";
        }
        echo "<p class='createdAt'>$this->createdAt</p>";
    }
}
