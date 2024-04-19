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
        $query = $db->prepare("SELECT pseudo,profile_picture FROM user WHERE id=?");
        $query->execute([$this->author]);
        $data = $query->fetch();
        if ($data) {
            echo "<div class='author-info'>";
            echo "<a class='hello' id='nav-link' href='../view/user.php?id=" . $this->author . "'>";
            echo "<span class='author'>" . $data["pseudo"] . "</span>";
            echo "</a>";
            if ($data["profile_picture"][0] == "#") {
                echo "<span class='picture' style='width: 48px;px; height=48px; background-color:".$data["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($data["pseudo"],0,1)."</span>";
            }else{
                echo "<span class='picture'>";
                echo "<img src='../image/avatar_user/".$data["profile_picture"]."' alt='Logo' style='width:48px;' id='img'>";
                echo" </span>";        
            }
            echo "</div>";
        } else {
            echo "<p class='author'>Unknown</p>";
        }

        echo "<p class='content'>$this->content</p>";
        $query = $db->prepare("SELECT image FROM post WHERE id=?");
        $query->execute([$this->id_post]);
        $data = $query->fetch();
        // var_dump($data); // Add this line for debugging
        if (isset($data["image"])) {
            echo "<img class='img' src='../image/post_photo/" . $data["image"] . "' alt='post image'>";
        }
        echo "<p class='createdAt'>$this->createdAt</p>";
    }
}
