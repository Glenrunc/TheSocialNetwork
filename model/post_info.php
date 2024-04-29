<?php

class Post
{
    private $id_post;
    private $content;
    private $author;
    private $createdAt;
    private $comments;
    private $flou;
    private $retirer;
    private $image;

    // private $like;

    public function __construct($id_post, $content, $author, $createdAt, $flou, $retirer,$image)
    {
        $this->id_post = $id_post;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->comments = array();
        $this->flou = $flou;
        $this->retirer = $retirer;
        $this->image = $image;
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

    public function getFlou()
    {
        return $this->flou;
    }
    public function getImage(){
        return $this->image;
    }

    public function displayPost()
    {   

        require("../model/database.php");
        global $db;
        require("../model/blur_delete_send_admin.php");        

        echo "<div class='post' id='post" . $this->getId() . "'>";
       
        $query = $db->prepare("SELECT pseudo,profile_picture FROM user WHERE id=?");
        $query->execute([$this->author]);
        $data = $query->fetch();
        if ($data) {
            echo "<div class='author-info'>";
            echo "<a class='hello' id='nav-link' href='../view/user.php?id=" . $this->author . "'>";
            echo "<span class='author'>" . $data["pseudo"] . "</span>";
            echo "</a>";
            if ($data["profile_picture"][0] == "#") {
                echo "<span id='picks' class='picture' style='width: 48px;px; height=48px; background-color:" . $data["profile_picture"] . "; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>" . substr($data["pseudo"], 0, 1) . "</span>";
            } else {
                echo "<span id='picks' class='picture'>";
                echo "<img src='../image/avatar_user/" . $data["profile_picture"] . "' alt='Logo' style='width:48px;' id='img'>";
                echo " </span>";
            }
            echo "</div>";
        } else {
            echo "<p class='author'>Unknown</p>";
        }
        
        echo "<p id = 'content" . $this->getId() . "' class='content'>$this->content</p>";

        if ($this->getImage()) {
            echo "<img id = 'img" . $this->getId() . "' class='img' src='../image/post_photo/" . $this->getImage() . "' alt='post image'>";
        }       
        echo "<p class='createdAt'>$this->createdAt</p>";

        if (isset($_SESSION["id_user"])) {
            $query = $db->prepare("SELECT COUNT(*) FROM likedpost WHERE id_post = ? AND id_user = ?");
            $query->execute([$this->getId(), $_SESSION["id_user"]]);
            $liked = $query->fetch()[0];
            
            $sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ?";
            $query = $db->prepare($sql);
            $query->execute([$this->getId()]);
            $like = $query->fetch()[0];
            ?>

            
            <?php

            if ($liked) {
                
                echo '<div id="dislike'.$this->getId().'">
                <button type="button" class="btn btn-danger mb-1" onclick="toLike('.$this->getId().')">Dislike</button>
                <span> Total amount of like : '.$like.'</span>
                </div>';
                
            } else {
                
                echo'<div id="like'.$this->getId().'">
                <button type="button" class="btn btn-success mb-1" onclick="toDislike('.$this->getId().')">Like</button>
                <span> Total amount of like : '.$like.'</span>
                </div>';
           }
        }
        echo "</div>";
        if ($this->getFlou() == 1) {
            echo " <script> window.onload = add_blur(" . $this->getId() . "); </script> ";

        } 

        $sql = "SELECT admin FROM user WHERE id = ?";
        $qry = $db->prepare($sql);
        $qry -> execute([$this->getAuthor()]);
        $result = $qry->fetch();
        if($result["admin"] == 1){
            echo " <script> window.onload = add_admin(" . $this->getId() . "); </script> ";

        }

       
       
    }
}
