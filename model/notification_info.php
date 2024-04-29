<?php
class Notification{
    private $id;
    private $id_user;
    private $id_post;
    private $content;
    private $date;
    private $hour;

    public function __construct($id,$id_user,$id_post,$content,$date,$hour)
    {   
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_post = $id_post;
        $this->content = $content;
        $this->date = $date;
        $this->hour = $hour;
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

        echo'
            <div>
                <p>'.$pseudo.', '.$this->getContent().'. '.$this->getHour().'</p>
            </div>
        ';
    }
}
?>