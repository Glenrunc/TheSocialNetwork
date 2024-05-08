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
    private $admin_post;
    // private $like;

    public function __construct($id_post, $content, $author, $createdAt, $flou, $retirer, $image)
    {
        require("../model/database.php");
        global $db;

        $this->id_post = $id_post;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->comments = array();
        $this->flou = $flou;
        $this->retirer = $retirer;
        $this->image = $image;

        $sql = "SELECT admin FROM user WHERE id = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$this->getAuthor()]);
        $result = $qry->fetch();
        $this->admin_post = $result["admin"];
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
    public function getImage()
    {
        return $this->image;
    }

    public function getAdmin()
    {
        return $this->admin_post;
    }

    public function displayPost()
    {

        require("../model/database.php");
        global $db;

        if ($this->getAdmin() == 1) {
            echo "<div class='post_admin' id='post" . $this->getId() . "'>";
        } else {
            echo "<div class='post' id='post" . $this->getId() . "'>";
        }

        if (!empty($_SESSION["admin"])) {

            echo '
                          <div class="btn-action" id="btn-action' . $this->getId() . '">
                              <div class="btn-group dropend">
                                  <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                      Moderate
                                  </button>
                                  <ul class="dropdown-menu">
                                  ';
            if ($this->getFlou() == 0) {
                echo '           <li><button id = "blur_post' . $this->getId() . '" class="dropdown-item" onclick="blurPost(' . $this->getId() . ',' . $this->getAuthor() . ')">Sensitive Content / Blur the post</button></li>
                                    ';
            }
            echo '
                                      <li><button id = "delete_post' . $this->getId() . '" class="dropdown-item" onclick="deletePost(' . $this->getId() . ')" >Delete this post </button></li>
                                      <li><button id = "sendWarning_post' . $this->getId() . '" class="dropdown-item" >Send warning to the user</button></li>
                                  </ul>
                              </div>
                          </div>
                      ';
        }

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

        if ($this->getFlou() == 1) {
            if (isset($_SESSION["id_user"])) {
                echo '<div class="btn_see">';
                echo '<button  id = "unblur_user' . $this->getId() . '" type="button" class="btn btn-warning btn-sm mb-1" onclick="unblurUserPosts(' . $this->getId() . ')" >See</button>';
                echo '</div>';
            } else {
                echo '<div class="info_btn">';
                echo '<span class="badge text-bg-danger">Create an account or connect to see the blur post</span>';
                echo '</div>';
            }
            echo '<div id="content-blur' . $this->getId() . '"  class="content-blur">';
        } else {
            echo '<div class="content-notblur" id="content' . $this->getId() . '">';
        }
        echo "<p id = 'content" . $this->getId() . "' class='content'>$this->content</p>";
        if ($this->getImage()) {
            echo "<img id = 'img" . $this->getId() . "' class='img' src='../image/post_photo/" . $this->getImage() . "' alt='post image'>";
        }
        echo "</div>";




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

                echo '<div id="dislike' . $this->getId() . '">
                <button type="button" class="btn btn-danger btn-sm mb-1" onclick="toLike(' . $this->getId() . ')">Dislike</button>
                <span> Total amount of like : ' . $like . '</span>
                </div>';
            } else {

                echo '<div id="like' . $this->getId() . '">
                <button type="button" class="btn btn-success btn-sm mb-1" onclick="toDislike(' . $this->getId() . ')">Like</button>
                <span> Total amount of like : ' . $like . '</span>
                </div>';
            }
        
        $sql = "SELECT COUNT(*) FROM comment WHERE id_post = ?";
        $query = $db->prepare($sql);
        $query->execute([$this->getId()]);
        $comment = $query->fetch()[0];
        $sql = "SELECT COUNT(*) FROM ban WHERE id_user = ?";
        $query = $db->prepare($sql);
        $query->execute([$_SESSION["id_user"]]);
        $ban = $query->fetch()[0];

        if ($ban == 0) {
            
        echo '
        
        <div class="commentIcon" id="commentIcon' . $this->getId() . '">
        <svg data-bs-toggle="collapse" href="#multiCollapseExample'. $this->getId() .'" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-chat-right-text" viewBox="0 0 16 16">
        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark sm">
        ' . $comment . '
        <span class="visually-hidden">unread messages</span>
        </span>
        </svg>
        </div>
        ';
        }
        }
        echo '
        <div class="goTo" id="goto' . $this->getId() . '">
        <a href="../view/post.php?id_post='. $this->getId() .'">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-text-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
        </svg>
        </a>
        </div>
        </div>';
        ?>
        <div class="collapse multi-collapse" id="multiCollapseExample<?php echo $this->getId(); ?>">
            <div class="card card-body">
               <?php require("../view/form_comment.php"); ?>
            </div>
        </div>
       
        <?php
        
    }
}
