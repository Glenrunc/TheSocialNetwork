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
              $("#wrap").css("display","block");
              
            }

          });
        }else{
          $("#searchresult").empty();
          $("#wrap").css("display","none");
        }
    })
})