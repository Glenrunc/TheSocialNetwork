function addDislikeComment(id_comment,id_user){
    $.ajax({
        url: "../ajax/like_dislike_comment.php",
        method: "POST",
        data: { id_comment: id_comment, id_user: id_user },
        success: function (data) {
            if (data === "dislike") {
                $("#like_comment"+id_comment).attr("fill","black");
                $("#like_comment"+id_comment).attr("onclick","addLikeComment("+id_comment+","+id_user+")");
                var count = document.getElementById("badge"+id_comment);
                count.innerHTML = parseInt(count.innerHTML) - 1 + " like";
                           
            }
        }
    });
}
