function withdraw_notif(id_notif) {

    if (confirm("Are you sure you want to delete this notification?")) {
        $.ajax({
            url: "../ajax/notif.php",
            method: "POST",
            data: { id: id_notif },
            success: function (data) {
                if (data === "Success") {
                    var notif = document.getElementById("notif"+id_notif);
                    notif.remove();
                    var count = document.getElementById("count");
                    if( parseInt(count.innerHTML) != 0){
                        count.innerHTML = parseInt(count.innerHTML) - 1;
                    }
                }
            }
        });
    }

   
}

function IsCheckedNotif(checked,id_notif){
    if(checked){
        $.ajax({
            url: "../ajax/notif.php",
            method: "POST",
            data: { id_notif_check: id_notif},
            success: function (data) {
                if (data === "Success") {
                    var notif = document.getElementById("notif"+id_notif);
                    notif.style.backgroundColor = "#ced4da";
                    var count = document.getElementById("count");
                    count.innerHTML = parseInt(count.innerHTML) - 1;
                }
            }
        });
    }else{
        $.ajax({
            url: "../ajax/notif.php",
            method: "POST",
            data: { id_notif_not_check: id_notif},
            success: function (data) {
                if (data === "Success") {
                    var notif = document.getElementById("notif"+id_notif);
                    notif.style.backgroundColor = "white";
                    var count = document.getElementById("count");
                    count.innerHTML = parseInt(count.innerHTML) + 1;
                }
            }
        });
    }
}