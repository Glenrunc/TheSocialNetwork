<?php 

class User{
    private $id_user;
    private $first_name;
    private $last_name;
    private $age;
    private $birthday;
    private $email;
    private $pseudo;
    private $admin;
    private $profile_picture;
    private $ban;

    public function __construct($id_user,$first_name,$last_name,$age,$birthday,$email,$pseudo,$admin,$profile_picture){
        
        $this->id_user = $id_user;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->pseudo = $pseudo;
        if($admin == null){
            $this->admin = 0;
        }else{
            $this->admin = $admin;
        }
        $this->profile_picture = $profile_picture;
        
    }
    
    function displayGestionPage(){
        //Create post_info.php
        $img_path = $this->profile_picture;
        echo'<div class="user_gestion">';

        if ($img_path[0] == "#") {
            echo "<a href='../view/user.php?id=".$this->id_user."'><div class='rounded-pill' style='width: 48px;px; height=48px; background-color:".$img_path."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($this->getPseudo(),0,1)."</div></a>";
        }else{
            echo "<div class='profile_picture'>";
            echo "<a href='../view/user.php?id=".$this->id_user."'><img src='../image/avatar_user/".$img_path."' alt='Logo' style='width:125px;' id='img'></a>";
            echo" </div>";        
        }
        echo "<div id='user_info'>";
        echo "<p class='info'>First name: $this->first_name</p>";
        echo "<p class='info'>Last name: $this->last_name</p>";
        echo "<p class='info'>Age: $this->age</p>";
        echo "<p class='info'>Birthday: $this->birthday</p>";
        echo "<p class='info'>Email: $this->email</p>";
        echo "<p class='info'>Pseudo: $this->pseudo</p>";
        echo "</div>";
        

    }

    function displayUserPage(){
        $img_path = $this->profile_picture;
        echo'<div class="user_presentation">';
        if ($img_path[0] == "#") {
            echo "<div class='rounded-pill' style='width: 48px;px; height=48px; background-color:".$img_path."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($this->getPseudo(),0,1)."</div>";
        }else{
            echo "<div class='profile_picture'>";
            echo "<img src='../image/avatar_user/".$img_path."' alt='Logo' style='width:125px;' id='img'>";
            echo" </div>";        
        }       
        
        echo "<div id='user_info'>";
        echo "<p class='info'>$this->pseudo</p>";
        echo "</div>";
        echo "</div>";   
       
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function isAdmin() {
        return $this->admin;
    }

    public function getProfilePicture() {
        return $this->profile_picture;
    }
}
?>