async function toLike(id_post){//add id_user_connected
    const buttonLike = document.getElementById("dislike"+id_post);
    if(buttonLike != null) {buttonLike.remove();}

    var AJAXresult  = await fetch("../ajax/toLike.php?id_post=" + id_post);
    writearea = document.getElementById("post"+id_post);
    writearea.innerHTML += await AJAXresult.text();

}