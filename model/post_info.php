<?php

class Post
{
    private $id;
    private $content;
    private $author;
    private $createdAt;
    private $comments;
    // private $like;

    public function __construct($content, $author, $createdAt ,$id)
    {
        $this->id = $id;
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
        echo "<p class='createdAt'>$this->createdAt</p>";
    }

    // public function getLike(){
    //     require("../model/database.php");
    //     global $db;
    //     $sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ?";
    //     $query = $db->prepare($sql);
    //     $query->execute([$this->id]);
    //     $this->like = $query->fetch()[0];
    // }
    // public function addLike($id_user)
    // {
    //     require("../model/database.php");
    //     global $db;
    //     $sql = "INSERT INTO likedpost (id_post,id_user) VALUES (?, ?)";
    //     $query = $db->prepare($sql);
    //     $query->execute([$this->id, $id_user]);
    //     $this->getLikes();
    // }

    // private function deleteLike($id_user)
    // {
    //     require("../model/database.php");
    //     global $db;
    //     $sql = "DELETE FROM likedpost WHERE id_post = ? AND id_user = ?";
    //     $query = $db->prepare($sql);
    //     $query->execute([$this->id, $id_user]);
    //     $this->getLikes();
    // }
}
