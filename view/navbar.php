<nav class="navbar navbar-expand-sm mt-5 my-3 navbar-dark rounded sticky-top" style="background-color: #303245; width: 800px;margin: 0 auto;">
  <div class="container ">
    <a class="navbar-brand" href="../view/index.php">
      <img src="../image/Logo_TZU.png" alt="Logo" style="width:40px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mynavbar">

      <input type="text" id="search" placeholder="What's happening ?!" autocomplete="off">
      <div id="searchresult"></div>


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
                if (isset($_SESSION["profile_picture"])) {
                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='' >";
                  
                } else {
                  
                  echo "<img src='../image/default_image.png' alt='Logo'  style='width:48px'; class='rounded-pill'";
                }
                
                echo "</a>";
              }
            }else{
                echo "<p id='para'>" . $_SESSION['pseudo'] . "</p>";
                echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
                echo " <a class'test' id='nav-link' href='../view/user.php?id=" . $_SESSION["id_user"] . "'>";
                
                if (isset($_SESSION["profile_picture"])) {
                  echo "<img src='../image/avatar_user/" . $_SESSION["profile_picture"] . "' alt='Logo' style='width:48px; height=48px;'class='' >";
                  
                } else {

                  echo "<img src='../image/default_image.png' alt='Logo'  style='width:48px'; class='rounded-pill'";
               
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="../script/ajax_search.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
