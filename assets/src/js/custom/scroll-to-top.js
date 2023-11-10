/**
* PAGE SCROLLING
* Internal anchor and top-of-page scrolling
* Toggle class of navbar on scroll to shrink and add shadow
*/

// jQuery stuff 
(function($) {
  
  // auto populate table of contents using .jumpLinkBlock elements 
  $(document).ready(function() {
    if ($('.jumpLinkBlock').length){

      var sidebarTOC = document.querySelector('.singlePost__entrySidebar-toc');
      $(sidebarTOC).removeClass( "-hidden" )

      var index = 0;
      $(".jumpLinkBlock").each(function() {
        var jumpLinkID = this.id;
        var jumpLinkShortText = document.querySelector('#' + jumpLinkID + ' .jumpLinkBlock__shortText');
        var jumpLinkFullText = document.querySelector('#' + jumpLinkID + ' .jumpLinkBlock__text');

        if ($(jumpLinkShortText).length > 0) {
          var jumpLinkText =  jumpLinkShortText.textContent; // get the short title if present 
        } else {
          jumpLinkText = jumpLinkFullText.textContent; // otherwise get the longjumpLinkFullText title 
        }

        var jumpLink = "<a class='jumpLinkBlock__link' href='#" + jumpLinkID + "'>" + jumpLinkText + "</a>"; 

        $(jumpLink).appendTo("#singlePostTOC");   
        index++; 
      });
    }
  });



// toggle navbar height and box shadow on scroll 
// styles are in _header.scss 
  masthead = document.getElementById("masthead");
  navbar = document.getElementById("navbar");
  var scrollNavbar = function () {
    var navbarDistance = window.scrollY;
    if (navbarDistance >= 150) {
    // addClass(navbar, '-scrolled'); // toggles height 
    // addClass(masthead, '-scrolled'); // toggles shadow  
      $(navbar).addClass("-scrolled"); 
      $(masthead).addClass("-scrolled"); 
    } else {
    // removeClass(navbar, '-scrolled'); 
    // removeClass(masthead, '-scrolled'); 
      $(navbar).removeClass("-scrolled"); 
      $(masthead).removeClass("-scrolled"); 
    }
  };
  window.addEventListener("scroll", scrollNavbar);


})(jQuery);


// SCROLL TO TOP BUTTON
// show scrollup button after scrolling 300px 
scrollToTopButton = document.getElementById("scroll-to-top");
var showScrollToTop = function () {
  var scrollTopDistance = window.scrollY;
  if (scrollTopDistance >= 300) {
    scrollToTopButton.style.opacity = "1";
  } else {
    scrollToTopButton.style.opacity = "0";
  }
};
window.addEventListener("scroll", showScrollToTop);
if (navbarDistance >= 150) {
  if ($(navbar).hasClass("-scrolled")) {
    $(navbar).addClass("-scrolled"); 
    $(masthead).addClass("-scrolled"); 
  } else {
    $(navbar).removeClass("-scrolled"); 
    $(masthead).removeClass("-scrolled"); 
  }
};



// console.log('scroll to top loaded');
