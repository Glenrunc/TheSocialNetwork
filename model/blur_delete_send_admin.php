<?php
if (!empty($_SESSION["admin"])) {
    
              echo '
                  <div class="btn-action" id="btn-action'.$post->getId().'">
                      <div class="btn-group">
                          <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Moderate
                          </button>
                          <ul class="dropdown-menu">
                              <li><button id = "blur_post'.$post->getId().'" class="dropdown-item" >Sensitive Content / Blur the post</button></li>
                              <li><button id = "delete_post'.$post->getId().'" class="dropdown-item" >Delete this post </button></li>
                              <li><button id = "sendWarning_post'.$post->getId().'" class="dropdown-item" >Send warning to the user</button></li>
                          </ul>
                      </div>
                  </div>
              ';
      
              // Script JavaScript pour gérer les clics sur les boutons
              echo '
                  <script>
                      $(document).ready(function(){

                          $("#blur_post'.$post->getId().'").click(function(){
                            var action = $("#blur_post'.$post->getId().'").text();
                            var id_user = '.$post->getAuthor().';
                            var id = '.$post->getId().';
                           
                            var reason = prompt("Enter the reason for blurring the post:","Your post may causes several problem regarding our rules ");
                            
                            if (confirm(action)) {
                                var blur = 1;
                                $.ajax({
                                    url: "../ajax/blur_post.php",
                                    method: "POST",
                                    data: { id: id, action: action , reason: reason, id_user: id_user},
                                    success: function (data) {
                                        if(data === "Success"){
                                            $("#flou'.$post->getId().'").css("filter", "blur(10px)");
                                            $("#blur_post'.$post->getId().'").remove();
                                        }     
                                    }
                                });
                            }
                            
                            if(blur){
                                $("#flou'.$post->getId().'").mouseover(function() {
                                    $("#flou'.$post->getId().'").css("filter", "blur(0px)");
                                });

                                $("#flou'.$post->getId().'").mouseout(function() {
                                    $("#flou'.$post->getId().'").css("filter", "blur(10px)");
                                });
                            }
   
                        });

                        $("#delete_post'.$post->getId().'").click(function(){

                            var action = $("#delete_post'.$post->getId().'").text();
                            var id = '.$post->getId().';
                            var reason = prompt("Enter the reason for deleting the post:","Your post may causes several problem regarding our rules, your has been deleted");
                            
                            if (confirm(action)) {
                                $.ajax({
                                    url: "../ajax/delete_post.php",
                                    method: "POST",
                                    data: { id: id, reason: reason },
                                    success: function (data) {
                                        if(data === "Success"){
                                            $("#flou'.$post->getId().'").remove();
                                            
                                        }     
                                    }
                                });
                            }
                        });
                      });
                  </script>
              ';
            
                    
    
}
          
?>