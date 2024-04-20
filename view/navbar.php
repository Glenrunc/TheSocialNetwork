<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../script/ajax_search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<nav class="navbar navbar-expand-sm mt-5 my-3 navbar-dark rounded" style="background-color: #303245; width: 800px;margin: 0 auto;">
  <div class="container ">
    <a class="navbar-brand" href="../view/index.php">
      <img src="../image/Logo_TZU.png" alt="Logo" style="width:40px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mynavbar">
      <input type="text" id="search" placeholder="Search for user ?!" autocomplete="off">


      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <?php
          if (isset($_SESSION["id_user"])) {

            if (isset($_GET['id'])) {
              echo "<script> console.log('id_user : " . $_GET["id"] . "')</script>";
              if ($_SESSION["id_user"] == $_GET['id']) {
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
              } else {
                echo "<p id='para'>" . $_SESSION['pseudo'] . "</p>";
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
                echo " <a class= 'hello' id='nav-link' href='../view/user.php?id=" . $_SESSION["id_user"] . "'>";
                if ($_SESSION["profile_picture"][0] != "#") {
                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='' ></a>";
                  
                } else {
                  
                  echo "<div class='rounded-pill' style='width:48px; height=48px; background-color:".$_SESSION["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($_SESSION['pseudo'],0,1)."</div></a>";
               
                }
                
            
              }
            }else{
                echo "<p id='para'>" . $_SESSION['pseudo'] . "</p>";
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
                echo " <a class'test' id='nav-link' href='../view/user.php?id=" . $_SESSION["id_user"] . "'>";
                
                if ($_SESSION["profile_picture"][0] != "#") {
                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='rounded-pill' ></a>";
                  
                } else {
                  
                  echo "<div class='rounded-pill' style='width:48px; height=48px; background-color:".$_SESSION["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($_SESSION['pseudo'],0,1)."</div></a>";
               
                }
                
            }
            
          } else {
            echo " <a id='nav-link' >";
            echo "<img src='../image/user.svg' alt='Logo' style='width:48px'; class='rounded-pill' onclick='checkAndRedirect()'";
            echo "</a>";
          }
          ?>

        </li>
      </ul>
    </div>
  </div>
</nav>

