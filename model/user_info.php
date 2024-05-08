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
        global $db;

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
        $sql = "SELECT COUNT(*) FROM ban WHERE id_user = ?";
                    $query = $db->prepare($sql);
                    $query->execute([$this->getIdUser()]);
                    $data = $query->fetch();
        $this->ban = $data[0];
        
    }
    public function getIdUser() {
        return $this->id_user;
    }

    public function getBan() {
        return $this->ban;
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
        global $db;
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
                  <?php
                    
                    if($this->getBan()   == 0){
                  ?>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#banModal">Ban</a></li>
                    <?php
                        }
                    ?>
                </ul>
              </div>
                </div>
                
                <!-- Modal -->
               <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h1 class="modal-title fs-5" id="banModalLabel">Ban User</h1>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                    <form action="../model/ban_user.php" method="post">
                        <input type="hidden" name="id_user_ban" value="<?php echo $this->getIdUser(); ?>">
                        <label for="NuberOfDays" class="form-label">Number of days banned from TZU.</label>
                        <input name="number_of_day_ban" type="range" class="form-range" min="0" max="100" id="NuberOfDays">
                        <span id="rangeValue" style="color:#FFFF00">50 days</span>
                        <script>
                            var rangeInput = document.getElementById("NuberOfDays");
                            var rangeValue = document.getElementById("rangeValue");

                            rangeInput.addEventListener("input", function() {
                                var value = rangeInput.value;
                                var color = getColor(value);
                                rangeValue.textContent = value + " days";
                                rangeValue.style.color = color;
                            });

                            function getColor(value) {
                                var hue = ((1 - value / 100) * 120).toString(10);
                                return ["hsl(", hue, ", 100%, 50%)"].join("");
                            }
                        </script>

                        <div class="input-group">
                          <span class="input-group-text">With textarea</span>
                          <textarea name ="reason_ban" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" class="btn btn-primary">Ban</button>
                         </div>
                    <form>
                     </div>
                     
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