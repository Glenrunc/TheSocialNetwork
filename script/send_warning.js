function sendWarning(id_user){
    
    var action = "Send Warning";
    var reason = prompt("Enter the reason for sending the warning:" + id_user, "Your comportement is problematic be aware that you could be ban from the website!");

    if (confirm(action)) {
        $.ajax({
            url: "../ajax/send_warning.php",
            method: "POST",
            data: { id_user: id_user, reason: reason },
            success: function (data) {
                if (data === "Success") {
                    alert("Warning sent successfully");
                }
            }
        });
    }
}