
<!-- Button trigger modal -->
<div class="notification">
<button  type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#NotifModal">
Notification
</button>
</div>

<!-- Modal -->
<div class="modal fade" id="NotifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <?php  
        $sql = "SELECT * FROM notification WHERE id_user = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$_SESSION['id_user']]);
        $notif = $qry->fetchAll();
        foreach($notif as $notification){
          $notificationData = $notification;
          $notification = new Notification($notificationData["id"],$notificationData["id_user"],$notificationData["id_post"],$notificationData["content"],$notificationData["date"],$notificationData["hour"]);
          $notification->displayNotification();
          ?>
            <hr>
        <?php
        }

      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>