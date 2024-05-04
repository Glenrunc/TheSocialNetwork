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


    public function __construct($id,$id_user,$id_post,$content,$date,$hour,$viewed,$retirer)
    {   
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_post = $id_post;
        $this->content = $content;
        $this->date = $date;
        $this->hour = $hour;
        $this->viewed = $viewed;
        $this->retirer = $retirer;

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

    public function displayNotification(){
        require("../model/database.php");
        global $db;

        $sql = "SELECT user.pseudo
        FROM user
        INNER JOIN notification ON user.id = notification.id_user
        WHERE notification.id_user = ? LIMIT 1;";

        $qry = $db->prepare($sql);
        $qry->execute([$this->getIdUser()]);
        $data = $qry->fetch();
        $pseudo = $data["pseudo"];

        if($this->getViewed() == 0){
            echo'<div class="notif" id=notif'.$this->getId().'>';
        }else{
            echo'<div class="notif_viewed" id=notif'.$this->getId().'>';
        }
        echo'<p>'.$pseudo.', '.$this->getContent().'. '.$this->getHour().'</p>';
       
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