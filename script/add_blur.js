function add_blur(id_post) {
    const img = document.getElementById("img"+id_post);
    if(img != null) {img.style.filter = "blur(5px)";}
    const content = document.getElementById("content"+id_post);
    if(content != null) {content.style.filter = "blur(5px)";}
    const buttonBlur = document.getElementById("blur_post"+id_post);
    if(buttonBlur != null) {buttonBlur.remove();}
}