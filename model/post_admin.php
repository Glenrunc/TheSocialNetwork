<?php
$sql = "SELECT flou FROM post WHERE id=?";
$query = $db->prepare($sql);
$query->execute([$this->getId()]);
$data = $query->fetch();

if ($data["flou"] == 1) {

?>
  <script>
    $(document).ready(function() {
      $("#img" + <?php echo $this->getId()  ?>).css("filter", "blur(5px)");
      $("#content"+ <?php echo $this->getId()  ?>).css("filter", "blur(5px)");
      $("#blur_post" + <?php echo $this->getId()  ?>).remove();
    })
  </script>
<?php
}
?>


<?php
$sql = "SELECT admin FROM user u INNER JOIN post p ON u.id = p.id_user WHERE p.id = ? ";
$query = $db->prepare($sql);
$query->execute([$this->getId()]);
$data = $query->fetch();

if ($data["admin"] == 1) {
?>
  <script>
    $(document).ready(function() {
      $("#post" + <?php echo $this->getId()  ?>).css("background-color", "#999BBA");
    })
  </script>
<?php
}

?>