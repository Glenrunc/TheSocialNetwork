document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('rectangle').style.display = 'none';
    document.getElementById('flou-body').style.display = 'none'; // Cacher le masque de flou pour le body
    // Retrait de la classe de flou à tout le body
    document.body.classList.remove('blur');
});

function checkSessionandRedirect() {
    $.ajax({
        url: 'check_session.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.sessionExists) {
                window.location.href = "user.php";
                return true;
            } else {
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('rectangle').style.display = 'block';
                document.getElementById('flou-body').style.display = 'block'; // Affichage du masque de flou pour le body
                // Ajout de la classe de flou à tout le body
                document.body.classList.add('blur');
                return false;
            }
        },
        error: function (xhr, status, error) {
            console.error('Error checking session status:', error);
        }
    });
}


