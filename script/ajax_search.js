$(document).ready(function(){
    $("#search").keyup(function(){
        var input = $(this).val();

        if(input != ""){
          $.ajax({
            url:"../ajax/livesearch.php",
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