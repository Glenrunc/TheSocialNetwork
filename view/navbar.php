<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../script/ajax_search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<nav id= "signin_query"class="navbar navbar-expand-lg navbar-dark rounded" style="background-color: #ece4db ;margin: 0 auto;">
  <div class="container ">
    <a class="navbar-brand" href="../view/index.php">
      <img src="../image/Logo_TZU.png" alt="Logo" style="width:40px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mynavbar">
      
      
      <span class="input-group-text" id="basic-addon1">@</span>
      <input type="text" id="search" class="form-control col-3" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" style="width:200px;">
    
    
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php        
          if (isset($_SESSION["id_user"])) {
            require("../model/notification_info.php");
            require("../view/notification.php");

            if (isset($_GET['id'])) {
              echo "<script> console.log('id_user : " . $_GET["id"] . "')</script>";
              if ($_SESSION["id_user"] == $_GET['id']) {
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
              } else {
                echo "<p id='para'>" . $_SESSION['pseudo'] . "</p>";
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
                echo " <a class= 'hello' id='nav-link' href='../view/user.php?id=" . $_SESSION["id_user"] . "'>";
                if ($_SESSION["profile_picture"][0] != "#") {
                  echo"<div id='icon'>";

                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='' ></a>";
                  echo"</div>";
                } else {
                  echo"<div id='icon'>";

                  echo "<div class='rounded-pill' style='width:48px; height=48px; background-color:".$_SESSION["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($_SESSION['pseudo'],0,1)."</div></a>";
                  echo"</div>";
                }
                
            
              }
            }else{
                echo "<p id='para'>" . $_SESSION['pseudo'] . "</p>";
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
                echo " <a class'test' id='nav-link' href='../view/user.php?id=" . $_SESSION["id_user"] . "'>";
                
                if ($_SESSION["profile_picture"][0] != "#") {
                  echo"<div id='icon'>";

                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='rounded-pill' ></a>";
                  echo"</div>";
                } else {
                  echo"<div id='icon'>";

                  echo "<div class='rounded-pill' style='width:48px; height=48px; background-color:".$_SESSION["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($_SESSION['pseudo'],0,1)."</div></a>";
                  echo"</div>";
                }
                
            }
            
          } else {
            echo"<div id='icon'>";
            echo " <a id='nav-link' >";
            echo "<img src='../image/user.svg' alt='Logo' style='width:48px'; class='rounded-pill' onclick='checkAndRedirect()'";
            echo "</a>";
            echo "</div>";
          }
          ?>
          <script>
            $(document).ready(function(){
              $("#icon").mouseover(function(){
                $("#signin_query").css("background-color", "#f5c396");
              });
              $("#icon").mouseout(function(){
                $("#signin_query").css("background-color", "#ece4db");
              });
            })
          </script>
        </li>
      </ul>
    </div>
  </div>
</nav>
<style>
  .notification{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
</style>

