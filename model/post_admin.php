<?php
$sql = "SELECT admin FROM user u INNER JOIN post p ON u.id = p.id_user WHERE p.id = ? ";
$query = $db->prepare($sql);
$query->execute([$post->getId()]);
$data = $query->fetch();

if ($data["admin"] == 1) {
?>
  <script>
    $(document).ready(function() {
      $("#post" + <?php echo $post->getId()  ?>).css("background-color", "#999BBA");
    })
  </script>
<?php
}

$sql = "SELECT flou FROM post WHERE id=?";
$query = $db->prepare($sql);
$query->execute([$post->getId()]);
$data = $query->fetch();

if ($data["flou"] == 1) {
?>
  <script>
    $(document).ready(function() {
      $("#flou<?php echo $post->getId()?>").css("filter", "blur(10px)");

      $("#flou<?php echo $post->getId()?>").mouseover(function() {
        $(this).css("filter", "blur(0px)");
      });

      $("#flou<?php echo $post->getId()?>").mouseout(function() {
        $(this).css("filter", "blur(10px)");
      });

      $("#blur_post<?php echo $post->getId()?>").remove();
    });
  </script>
<?php
}
?>
