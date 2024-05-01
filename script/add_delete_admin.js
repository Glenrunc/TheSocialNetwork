function deletePost(id) {
    var action = "Delete this post";
    var reason = prompt("Enter the reason for deleting the post:", "Your post may cause several problems regarding our rules, your post has been deleted");

    if (confirm(action)) {
        $.ajax({
            url: "../ajax/delete_post.php",
            method: "POST",
            data: { id: id, reason: reason },
            success: function (data) {
                if (data === "Success") {
                    $("#post" + id).remove();
                    $("#btn-action" + id).remove();
                }
            }
        });
    }
}

function undeletePost(postId) {
    if (confirm("Are you sure you want to undelete this post?")) {
        $.ajax({
            url: "../ajax/delete_post.php",
            type: "POST",
            data: { id_undelete: postId },
            success: function (data) {
                $("#post" + postId).remove();
                $("#undelete" + postId).remove();
            }
        });
    }
}