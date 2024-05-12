/*hamburger menu*/
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".rows");
const dropdownContainer = document.querySelector(".dropdown-container");
const dropdownHome = document.querySelector(".dropdown-home");
const dropdownContent = document.querySelector(".dropdown-content")

hamburger.addEventListener("click", () => {
    navMenu.classList.toggle("active");
    hamburger.classList.toggle("active");
    document.getElementsByTagName("body")[0].classList.toggle("fixed");
})

/*need to prepare it*/

function openMenu(id) {
    console.log(id);
  document.getElementById(id).classList.toggle("show");
  //dropdownContainer.classList.toggle("show");
  dropdownHome.classList.add("active");
}

dropdownContainer.addEventListener('blur', (event) => {
  dropdownWindow.classList.remove('show');
});

/*function clickOnFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

  function toggleDropdown(index) {
    for (var i = 0; i < dropdownContent.length; i++) {
      var element = dropdownContent[i];
      if (i === index) {
        element.classList.toggle('show');
      } else {
        element.classList.remove('show');
      }
    }
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function (event) {
    if (!event.target.matches('.dropdown-btn')) {
      var dropdowns = document.getElementsByClassName('dropdown-cnt');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };*/
  
var prevScrollpos = window.pageYOffset;

window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-166px";
  }
  prevScrollpos = currentScrollPos;
  
  if (window.scrollY >= 60 || currentScrollPos >= 60) {
    document.getElementsByTagName("header")[0].classList.add("inverted");
  } else {
    document.getElementsByTagName("header")[0].classList.remove("inverted");
  }
};

$('.slick-elements').slick({
  dots: true,
  prevArrow: false,
  nextArrow: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});