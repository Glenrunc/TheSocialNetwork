<?php
require("../model/database.php");
$sql = "SELECT COUNT(*) FROM follow WHERE id_follow = ?";
$qry = $db->prepare($sql);
$qry->execute([$_GET["id"]]);
$countFollowers = $qry->fetch();

$sql = "SELECT COUNT(*) FROM follow WHERE id_user = ?";
$qry = $db->prepare($sql);
$qry->execute([$_GET["id"]]);
$countFollowing = $qry->fetch();

echo '
<div class="modal fade modal-dialog-scrollable" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">'.$countFollowers[0].' Followers</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">';
        $sql = "SELECT id_user FROM follow WHERE id_follow = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$_GET["id"]]);
        $data = $qry->fetchAll();
        if(empty($data)) {
            echo "<p>No followers yet !</p>";
        }else{
          foreach ($data as $follow) {
            $sql = "SELECT * FROM user WHERE id = ?";
            $qry = $db->prepare($sql);
            $qry->execute([$follow["id_user"]]);
            $user = $qry->fetch();

            echo '<div class="followers_pres">';
            if ($user["profile_picture"][0] == "#") {
                echo "<div class='rounded-pill' style='width: 48px; height=48px; background-color:".$user["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($user["pseudo"],0,1)."</div>";
            }else{
                echo "<div class='profile_picture_followers'>";
                echo "<img src='../image/avatar_user/".$user["profile_picture"]."' alt='Logo' style='width:48px;' id='img'>";
                echo" </div>";        
            }       
            echo '<a href="../view/user.php?id='.$user["id"].'">'.$user["pseudo"].'</a>';
            echo '</div>';
            echo '<hr>';
          }
        }
echo' </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Following</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog  modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">'.$countFollowing[0].' Following</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">';

      $sql ="SELECT id_follow FROM follow WHERE id_user = ?";
      $qry = $db->prepare($sql);
      $qry->execute([$_GET["id"]]);
      $data = $qry->fetchAll();
      if (empty($data)) {
        echo "<p>Follow someone !</p>";
      }else{
        foreach ($data as $followed) {
          $sql = "SELECT * FROM user WHERE id = ?";
          $qry = $db->prepare($sql);
          $qry->execute([$followed["id_follow"]]);
          $user = $qry->fetch();

          echo '<div class="followers_pres">';
          if ($user["profile_picture"][0] == "#") {
              echo "<div class='rounded-pill' style='width: 48px; height=48px; background-color:".$user["profile_picture"]."; color:aliceblue; text-align: center; line-height: 48px; font-size: 20px; border-radius: 50%;'>".substr($user["pseudo"],0,1)."</div>";
          }else{
              echo "<div class='profile_picture_followers'>";
              echo "<img src='../image/avatar_user/".$user["profile_picture"]."' alt='Logo' style='width:48px;' id='img'>";
              echo" </div>";        
          }       
          echo '<a href="../view/user.php?id='.$user["id"].'">'.$user["pseudo"].'</a>';
          echo '</div>';
          echo '<hr>';
        }
    }
        

echo' </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to followers</button>
      </div>
    </div>
  </div>
</div>                    
';
echo'
<div class="icon_followers">
<svg data-bs-target="#exampleModalToggle" data-bs-toggle="modal" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0D6EFD" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
</svg>';

if ($countFollowers[0] != 0) {
  echo '
 
  <h6 class ="badge_follower"><span class="badge rounded-pill text-bg-primary">'.$countFollowers[0].' Followers</span></h6>
  </span>
  </div>';

}

?>