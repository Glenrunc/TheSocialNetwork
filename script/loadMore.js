//Pour utiliser fetch, la fonction doit ÃĒtre "asynchrone"
async function loadMorePosts(numberOfPostsAlready) {

	//Efface le bouton prÃŠcÃŠdent, car il sera remplacÃŠ
    const buttonMore = document.getElementById('morePosts');
    if (buttonMore != null ) {buttonMore.remove();}

	//Le AJAX qui va chercher les nouveaux posts
    var AJAXresult = await fetch("../ajax/loadMe.php?firstPost=" + numberOfPostsAlready);
    writearea = document.getElementById("recent");
    writearea.innerHTML += await AJAXresult.text();
}