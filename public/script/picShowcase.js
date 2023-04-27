const imgThumb = document.querySelectorAll(".thumbs img");
const imgShow = document.querySelector("img.showcased");
imgThumb.forEach(img => {
    if(img.classList.contains("nSel")){
        img.addEventListener('click', ()=>{
            imgThumb.forEach(simg => {
                if(simg.classList.contains("selected")){
                    simg.classList.replace("selected", "nSel");
                }
            });
            img.classList.replace("nSel", "selected");
            imgShow.src = img.src;
        })
    }
});
imgThumb[0].click();
