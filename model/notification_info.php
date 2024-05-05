<?php
class Notification{
    private $id;
    private $id_user;
    private $id_post;
    private $content;
    private $date;
    private $hour;
    private $viewed;
    private $retirer;
    private $id_like;
    private $warning;

    public function __construct($id,$id_user,$id_post,$content,$date,$hour,$viewed,$retirer,$id_like,$warning)
    {   
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_post = $id_post;
        $this->content = $content;
        $this->date = $date;
        $this->hour = $hour;
        $this->viewed = $viewed;
        $this->retirer = $retirer;
        $this->id_like = $id_like;
        $this->warning = $warning;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getIdPost()
    {
        return $this->id_post;
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

    public function getViewed()
    {
        return $this->viewed;
    }

    public function getRetirer()
    {
        return $this->retirer;
    }

    public function getIdLike()
    {
        return $this->id_like;
    }

    public function getWarning()
    {
        return $this->warning;
    }

    public function displayNotification(){
        require("../model/database.php");
        global $db;


        if($this->getViewed() == 0){
            echo'<div class="notif" id=notif'.$this->getId().'>';
        }else{
            echo'<div class="notif_viewed" id=notif'.$this->getId().'>';
        }       
        if($this->getIdLike() != NULL){
            $sql = "SELECT id_user FROM likedpost WHERE id = ?";
            $qry = $db->prepare($sql);
            $qry->execute([$this->getIdLike()]);
            $id_user = $qry->fetch()[0];

            $sql = "SELECT pseudo FROM user WHERE id = ?";
            $qry = $db->prepare($sql);
            $qry->execute([$id_user]);
            $pseudo = $qry->fetch()[0];
            echo'<p><a href="../view/user.php?id='.$id_user.'">'.$pseudo.'</a> '.$this->getContent().' <a href="../view/post.php?id_post='.$this->getIdPost().'">post</a></p>';
        }

        if($this->getWarning() == 1){
            echo'<p>'.$this->getContent().'</p>';
        }

        echo'<span class="hour"><p>'.$this->getDate().' '.$this->getHour().'</p></span>';
        echo'<span class="check" id="check'.$this->getId().'">';
        echo'<div class="form-check form-switch">';
        echo'<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onchange="IsCheckedNotif(this.checked,'.$this->getId().')"';
        if($this->getViewed() == 1){
            echo 'checked';
        }   
        echo '>';
        echo'</div>';
        echo'</span>';
        echo '<span class="close_cross" id="close'.$this->getId().'">';
        echo'<button type="button" class="btn-close btn-sm" aria-label="Close" onclick="withdraw_notif('.$this->getId().')"></button>';
        echo '</span>';
        echo' </div>';
        echo '<hr>';
       
    }
}
?>