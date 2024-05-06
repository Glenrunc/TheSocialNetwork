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
        return $this->id_comment;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function displayComment(){
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
                echo "<span id='picks' class='picture' style='width: 48px; height=48px; background-color:" . $data["profile_picture"] . "; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>" . substr($data["pseudo"], 0, 1) . "</span>";
            } else {
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
                echo "<img id = 'imgComment" . $this->getIdComment() . "' class='imgComment' src='../image/comment_photo/" . $this->getImage() . "' alt='comment image'>";
                ?>
                </div>
                <?php
            }
                ?>
            <div class="comment-info">
                <p><?php echo $this->date ?> <?php echo $this->hour ?></p>
            </div>
        </div>
        <?php
    }
}
?>