function displayfichetech() {
    var dropdown = document.getElementById("fiche-technique");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
  }






function addActiveClass(element) {
    // Get the parent element of the clicked image
    var imageGallery = document.getElementById("imageGallery");
    var imgHolders = imageGallery.getElementsByClassName("img-holder");
  
    // Remove the "active" class from all image holders
    for (var i = 0; i < imgHolders.length; i++) {
      imgHolders[i].classList.remove("active");
    }
  
    // Add the "active" class to the clicked image holder
    element.parentElement.classList.add("active");
  }
  
