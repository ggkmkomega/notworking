const langSelector = document.querySelector("#lang-selector");
const langOption = document.querySelector("#lang-options");
const btn = document.querySelector("#lang-btn");

btn.addEventListener("click", () => {
    return langSelector.classList.toggle("Opened");
})

