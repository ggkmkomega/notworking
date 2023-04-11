const header = document.querySelector("header");
const searchIcon = document.querySelector("#searchIcon");

searchIcon.addEventListener("click", () => {
    header.classList.toggle("openSearch");
    if(header.classList.contains("openSearch"))
    {
        return searchIcon.classList.replace("uil-search","uil-times");
    }
    searchIcon.classList.replace("uil-times","uil-search");
    
})
