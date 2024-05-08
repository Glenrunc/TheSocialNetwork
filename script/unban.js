function unban(id_user){
    if(confirm("Are you sure you want to unban this user?")){
        $.ajax({
            url: "../ajax/unban.php",
            type: "POST",
            data: { id_user: id_user},
            success: function (data) {
                console.log(data);
            }
        })
    }
}