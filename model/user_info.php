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
    public function getIdUser() {
        return $this->id_user;
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
        if(isset($_SESSION['id_user'])){
            if($_SESSION['id_user'] == 40 && $this->getIdUser() != 40   ){
                ?>
                <div class="manage_user">
                <div class="dropdown dropend">
                <svg type="button" data-bs-toggle="dropdown" aria-expanded="false" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#0D6EFD" class="bi bi-asterisk" viewBox="0 0 16 16">
                <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                </svg>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" onclick="sendWarning(<?php echo $this->getIdUser(); ?>)">Send a warning</a></li>
                  <li><a class="dropdown-item" href="#">Ban</a></li>
                </ul>
              </div>
                </div>
                
                <?php
            }
        }
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