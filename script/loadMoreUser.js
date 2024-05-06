//Pour utiliser fetch, la fonction doit ÃĒtre "asynchrone"
async function loadMorePosts(numberOfPostsAlready, id) {
    console.log("loadMorePosts");
	//Efface le bouton prÃŠcÃŠdent, car il sera remplacÃŠ
    const buttonMore = document.getElementById('morePosts');
    if (buttonMore != null ) {buttonMore.remove();}

	//Le AJAX qui va chercher les nouveaux posts
    var AJAXresult = await fetch("../ajax/loadMeUser.php?firstPost=" + numberOfPostsAlready + "&id=" + id);
    writearea = document.getElementById("postbox");
    writearea.innerHTML += await AJAXresult.text();

}