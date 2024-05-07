function addLikeComment(id_comment,id_user){
        $.ajax({
            url: "../ajax/like_dislike_comment.php",
            method: "POST",
            data: { id_comment: id_comment, id_user: id_user },
            success: function (data) {
                if (data === "like") {
                    console.log("like_comment"+id_comment);

                    $("#like_comment"+id_comment).attr("fill","red");
                    $("#like_comment"+id_comment).attr("onclick","addDislikeComment("+id_comment+","+id_user+")");
                    var count = document.getElementById("badge"+id_comment);
                    count.innerHTML = parseInt(count.innerHTML) + 1 + " like";
                }
            }
        });
}
