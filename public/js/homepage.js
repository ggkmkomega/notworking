document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        // Get the target element
        const target = document.querySelector(this.getAttribute('href'));

        // Scroll to the target element
        target.scrollIntoView({
            behavior: 'smooth'
        });
    });
});




function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
  }


let questions=document.querySelectorAll('.question-answer');
questions.forEach(function(question){
    let btn=question.querySelector('.question-btn');
    btn.addEventListener("click",function(){
        questions.forEach(function(item){
            if(item!==question){
                item.classList.remove("show");
            }
        })
        question.classList.toggle("show");
    })
})

/*for animation*/

const animateOnVisit = document.querySelectorAll('.animate-on-visit');

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate__animated', 'animate__' + entry.target.dataset.aos);
    }
  });
});

animateOnVisit.forEach(animate => {
  observer.observe(animate);
});
