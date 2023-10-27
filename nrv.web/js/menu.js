document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.getElementById('burger-menu');
    const mobileNav = document.querySelector('.mobile-nav');
  
    if (burgerMenu) {
      burgerMenu.addEventListener('click', function () {
        console.log('cest ok');
        mobileNav.classList.toggle('active'); });
    }
  });
  

  function myFunction() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }