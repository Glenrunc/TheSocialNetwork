document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('rectangle').style.display = 'none';
    document.getElementById('flou-body').style.display = 'none'; // Cacher le masque de flou pour le body
    // Retrait de la classe de flou à tout le body
    // document.body.classList.remove('blur');
});

function checkAndRedirect() {
    
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('rectangle').style.display = 'block';
    document.getElementById('flou-body').style.display = 'block'; // Affichage du masque de flou pour le body
    // document.body.classList.add('blur');
      
 
}

function showRecent() {
  window.location.replace("index.php");  
}
  
function showFollowed() {
  window.location.replace("followed_feed.php");
}