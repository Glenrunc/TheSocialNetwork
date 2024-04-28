<?php
if (!empty($_SESSION["admin"])) {
    
              echo '
                  <div class="btn-action" id="btn-action'.$this->getId().'">
                      <div class="btn-group">
                          <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Moderate
                          </button>
                          <ul class="dropdown-menu">
                              <li><button id = "blur_post'.$this->getId().'" class="dropdown-item" >Sensitive Content / Blur the post</button></li>
                              <li><button id = "delete_post'.$this->getId().'" class="dropdown-item" >Delete this post </button></li>
                              <li><button id = "sendWarning_post'.$this->getId().'" class="dropdown-item" >Send warning to the user</button></li>
                          </ul>
                      </div>
                  </div>
              ';
      
              // Script JavaScript pour gérer les clics sur les boutons
              echo '
                  <script>
                      $(document).ready(function(){

                          $("#blur_post'.$this->getId().'").click(function(){
                            var action = $("#blur_post'.$this->getId().'").text();
                            var id_user = '.$this->getAuthor().';
                            var id = '.$this->getId().';
                           
                            var reason = prompt("Enter the reason for blurring the post:","Your post may causes several problem regarding our rules ");
                            
                            if (confirm(action)) {
                        
                                $.ajax({
                                    url: "../ajax/blur_post.php",
                                    method: "POST",
                                    data: { id: id, action: action , reason: reason, id_user: id_user},
                                    success: function (data) {
                                        if(data === "Success"){
                                            $("#img'.$this->getId().'").css("filter", "blur(10px)");
                                            $("#content'.$this->getId().'").css("filter", "blur(10px)");
                                            $("#blur_post'.$this->getId().'").remove();
                                        }     
                                    }
                                });
                            }
                            
                        
   
                        });

                        $("#delete_post'.$this->getId().'").click(function(){

                            var action = $("#delete_post'.$this->getId().'").text();
                            var id = '.$this->getId().';
                            var reason = prompt("Enter the reason for deleting the post:","Your post may causes several problem regarding our rules, your has been deleted");
                            
                            if (confirm(action)) {
                                $.ajax({
                                    url: "../ajax/delete_post.php",
                                    method: "POST",
                                    data: { id: id, reason: reason },
                                    success: function (data) {
                                        if(data === "Success"){
                                            $("#post'.$this->getId().'").remove();
                                            $("#btn-action'.$this->getId().'").remove();
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