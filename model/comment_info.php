<?php
class Comment
{
    private $id_comment;
    private $id_post;
    private $id_user;
    private $content;
    private $date;
    private $hour;
    private $image;

    public function __construct($id_comment, $id_post, $id_user, $content, $date, $hour, $image)
    {
        // Constructor to initialize the Comment object
        $this->id_comment = $id_comment;
        $this->id_post = $id_post;
        $this->id_user = $id_user;
        $this->content = $content;
        $this->date = $date;
        $this->hour = $hour;
        $this->image = $image;
    }

    public function getIdComment()
    {
        // Getter method for id_comment
        return $this->id_comment;
    }

    public function getIdPost()
    {
        // Getter method for id_post
        return $this->id_post;
    }

    public function getIdUser()
    {
        // Getter method for id_user
        return $this->id_user;
    }

    public function getContent()
    {
        // Getter method for content
        return $this->content;
    }

    public function getDate()
    {
        // Getter method for date
        return $this->date;
    }

    public function getHour()
    {
        // Getter method for hour
        return $this->hour;
    }

    public function getImage()
    {
        // Getter method for image
        return $this->image;
    }

    public function displayComment(){
        // Method to display the comment
        require("../model/database.php");
        global $db;

        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $db->prepare($sql);
        $query->execute([$this->getIdUser()]);
        $data = $query->fetch();
        if($data["admin"]==1){
        ?>
        <div class="comment-admin" id="comment<?php echo $this->id_comment ?>">
        <?php
        }else {
        ?>
        <div class="comment" id="comment<?php echo $this->id_comment ?>">
        <?php
        }
        ?>
            <div class="comment-author">
            <?php
            if ($data["profile_picture"][0] == "#") {
                // Display a colored circle with the first letter of the user's pseudo if the profile picture is a color code
                echo "<span id='picks' class='picture' style='width: 48px; height=48px; background-color:" . $data["profile_picture"] . "; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>" . substr($data["pseudo"], 0, 1) . "</span>";
            } else {
                // Display the user's profile picture if it is an image
                echo "<span id='picks' class='picture'>";
                echo "<img src='../image/avatar_user/" . $data["profile_picture"] . "' alt='Logo' style='width:48px;' id='img'>";
                echo " </span>";
            }?>
            <p><a href="../view/user.php?id=<?php echo $data["id"] ?>"><?php echo $data["pseudo"] ?></a></p>
            </div>
            <div class="comment-content">
                <p><?php echo $this->content ?></p>
            </div>
            <?php
            if ($this->getImage()) {
            ?>
                <div class="comment-image">
                <?php
                // Display the comment image if it exists
                echo "<img id = 'imgComment" . $this->getIdComment() . "' class='imgComment' src='../image/comment_photo/" . $this->getImage() . "' alt='comment image'>";
                ?>
                </div>
                <?php
            }
                ?>
            <div class="comment-info">
                <p><?php echo $this->date ?> <?php echo $this->hour ?></p>
            </div>
            <?php
            if(isset($_SESSION["id_user"])){
                $sql = "SELECT COUNT(*) FROM likedcomment WHERE id_comment = ? AND id_user = ?";
                $query = $db->prepare($sql);
                $query->execute([$this->getIdComment(),$_SESSION["id_user"]]);
                $liked = $query->fetch()[0];

                $sql="SELECT COUNT(*) FROM likedcomment WHERE id_comment = ?";
                $query = $db->prepare($sql);
                $query->execute([$this->getIdComment()]);
                $likes = $query->fetch()[0];


                if($liked){
                    ?>
                    <div class="comment-like">
                    <svg id="like_comment<?php echo $this->getIdComment() ?>" class="like_comment" onclick="addDislikeComment(<?php echo $this->getIdComment() ?>,<?php echo $_SESSION["id_user"] ?>)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                    </svg>
                    <span id="badge<?php echo $this->getIdComment() ?>" class="badge bg-danger"><?php echo $likes ?> like</span>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="comment-like">
                    <svg type="button" id="like_comment<?php echo $this->getIdComment() ?>" class="like_comment" onclick="addLikeComment(<?php echo $this->getIdComment() ?>,<?php echo $_SESSION["id_user"] ?>)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                    </svg>
                    <span id="badge<?php echo $this->getIdComment() ?>" class="badge bg-danger"><?php echo $likes ?> like</span>
                    </div>
                    <?php
                }

            }
            ?>
        </div>
        <?php
    }
}
?>
