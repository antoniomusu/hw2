function OpenAnime(event){
    event.stopPropagation();
    location.href = "/anime/"+event.currentTarget.id;
}

const anime= document.querySelectorAll("#container>div");
for(const a of anime){
    a.addEventListener("click", OpenAnime);
}
