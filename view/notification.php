<!-- Button trigger modal -->
<script src="../script/withdraw_notif.js"></script>

<div class="notification">
  <button type="button" class="btn btn-light " data-bs-toggle="modal" data-bs-target="#NotifModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
      <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
    </svg>
    <span id="count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
      <?php
      $sql = "SELECT COUNT(*) FROM notification WHERE id_user = ? AND retirer = 0 AND viewed = 0";
      $qry = $db->prepare($sql);
      $qry->execute([$_SESSION['id_user']]);
      $count = $qry->fetch();
      echo $count[0];
      ?>
      <span class="visually-hidden">unread messages</span>
    </span>
  </button>
</div>

<!-- Modal -->
<div class="modal fade modal-xl" id="NotifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php

        $sql = "UPDATE notification SET retirer = 1 WHERE id_user = ? AND date < DATE_SUB(NOW(), INTERVAL 2 WEEK)";
        $qry = $db->prepare($sql);
        $qry->execute([$_SESSION['id_user']]);

        $sql = "SELECT * FROM notification WHERE id_user = ? AND retirer = 0 ORDER BY date DESC, hour DESC";
        $qry = $db->prepare($sql);
        $qry->execute([$_SESSION['id_user']]);
        $notif = $qry->fetchAll();

        if (empty($notif)) {
          echo "<p>Sorry, no notification for today</p>";
        } else {
          foreach ($notif as $notification) {
            $notificationData = $notification;
            if ($notificationData["retirer"] == 0) {
              $notification = new Notification($notificationData["id"], $notificationData["id_user"], $notificationData["id_post"], $notificationData["content"], $notificationData["date"], $notificationData["hour"], $notificationData["viewed"], $notificationData["retirer"], $notificationData["id_like"], $notificationData["warning"], $notificationData["id_comment"], $notificationData["id_follow"], $notificationData["id_like_comment"]);
              $notification->displayNotification();
            }

        ?>
        <?php
          }
        }

        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>