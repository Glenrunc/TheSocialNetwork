<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TZU</title>
  <link href="../css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>

  <?php
  require("../model/database.php");
  session_start();
  ?>
  <?php require("navbar.php") ?>


  <div id="overlay"></div>
  <div id="rectangle">
    <?php require("../model/signin.php") ?>
  </div>

  <div id="flou-body"></div>
  <div id="searchresult"></div> 
  <script src="script.js"></script>
  <script type=text/javascript>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var input = $(this).val();

            if(input != ""){
              $.ajax({
                url:"livesearch.php",
                method:"POST",
                data:{input:input},

                success:function(data){
                  $("#searchresult").html(data);
                }

              });
            }else{
              $("#searchresult").empty();
            }
        })
    })
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>