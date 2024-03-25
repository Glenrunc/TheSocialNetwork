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
    
    function displayUserPage(){

        
        //Create post_info.php
        $img = base64_encode($this->profile_picture);
    
        echo "<div id='profile_picture'>";
        echo "<img src='data:image/png;base64," . $img . "' alt='Logo' style='width:100px;' id='img'>";
        echo" </div>";
        echo "<div id='user_info'>";
        echo "<p class='info'>First name: $this->first_name</p>";
        echo "<p class='info'>Last name: $this->last_name</p>";
        echo "<p class='info'>Age: $this->age</p>";
        echo "<p class='info'>Birthday: $this->birthday</p>";
        echo "<p class='info'>Email: $this->email</p>";
        echo "<p class='info'>Pseudo: $this->pseudo</p>";
        echo "<p class='info'>Admin: $this->admin</p>";
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