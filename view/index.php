<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


    <title>TZU</title>
  </head>
  <body>
    <?php require("navbar.php") ?>
    
    <!-- Just a test for the connection to the BDD -->

    <!-- <?php 
      require("database.php");  
      global $db;
      $sql = "SELECT * FROM user WHERE admin=1";

      $query = $db->prepare($sql);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach($result as $res){
        echo $res['first_name'];
      }
    ?> -->

  </body>
</html>