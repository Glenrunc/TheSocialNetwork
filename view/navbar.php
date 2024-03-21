<nav class="navbar navbar-expand-sm mt-5 my-3 navbar-dark rounded" style="background-color: #BCD0C7;">
    <div class="container-fluid ">
      <a class="navbar-brand" href="#">
        <img src="../image/Logo_TZU.png" alt="Logo" style="width:40px;" class="rounded-pill">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mynavbar">
        <form method="POST" action="#">
          <input type="search" id="search" placeholder="What's happening ?!">
          <button type="submit" id="button">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <?php
            if (isset($_SESSION["id_user"])) {
              echo "<a id='nav-link' href='../model/deconnect.php'>Deconnection</a>";
              echo " <a id='nav-link'>";
              echo "<img src='../image/user.svg' alt='Logo' style='width:48px'; class='rounded-pill' onclick='redirect()'";
              echo "</a>";
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