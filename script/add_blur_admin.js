function blurPost(id, author) {
    var action = "Sensitive Content / Blur the post";
    var reason = prompt("Enter the reason for blurring the post:", "Your post may cause several problems regarding our rules");

    if (confirm(action)) {
        $.ajax({
            url: "../ajax/blur_post.php",
            method: "POST",
            data: { id: id, action: action, reason: reason, id_user: author },
            success: function (data) {
                if (data === "Success") {
                    $("#img" + id).css("filter", "blur(10px)");
                    $("#content" + id).css("filter", "blur(10px)");
                    $("#blur_post" + id).remove();
                }
            }
        });
    }
}

function unblurPost(postId) {
             
if(confirm("Are you sure you want to unblur this post?")){
    $.ajax({
        url: "../ajax/blur_post.php",
        type: "POST",
        data: {id_unblur: postId},
        success: function(data){
            $("#post"+postId).remove();
            $("#unblur"+postId).remove();
        }
    });
    
}
        
  
}

