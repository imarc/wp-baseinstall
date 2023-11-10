/**
* MOBILE NAVIGATION
* Plain JavaScript functions to toggle the mobile navigation, no jQuery required
* WAI-ARIA values are also added for accessibility 
*/

// Add toggles to menu items that have submenus and bind to click event
var subMenuItems = document.body.querySelectorAll('.siteNavigation .menu-item-depth-0.menu-item-has-children > a');
    index = 0;

for (index = 0; index < subMenuItems.length; index++) {
  var dropdownArrow = document.createElement('span');
  dropdownArrow.className = 'subMenuToggle';
  dropdownArrow.innerHTML = 'More';
  subMenuItems[index].parentNode.insertBefore(dropdownArrow, subMenuItems[index].nextSibling);
}



// Enable toggling all submenus individually
var subMenuToggle = document.querySelectorAll('.subMenuToggle'); 
    submenuToggleText = document.querySelectorAll('.siteNavigation .menu-item-depth-0.menu-item-has-children');

for(var i in subMenuToggle) {
  if(subMenuToggle.hasOwnProperty(i)) {
    submenuToggleText[i].onclick = function() {
      this.querySelector('.subMenu').classList.toggle("-subMenuOpen");
      this.querySelector('.subMenuToggle').classList.toggle("-subMenuOpen");
      this.classList.toggle("-subMenuOpen");
    };
  }
}




// Mobile navigation and search controls
// uses class-helpers.js to enable jQuery-like controls over class manipulation
var menuContainer = document.querySelector('.siteNavigation');
    outsideMenu = document.querySelector('.siteContent__wrap');
    menuToggle = document.querySelector('.menuToggle');
    // navMenu = document.querySelector('.nav-menu');

    // set WAI-ARIA values for nav and toggle button
    menuToggle.setAttribute( 'aria-expanded', 'false' );
    menuContainer.setAttribute( 'aria-expanded', 'false' );








(function($) {

// Toggle main menu and set WAI-ARIA values when menu button is clicked
  menuToggle.onclick = function() {

    if ($(menuContainer).hasClass('-mainMenuOpen')) {
      // removeClass(menuToggle, '-menuOpen'); 
      // removeClass(menuContainer, '-mainMenuOpen');
      $(menuToggle).removeClass("-menuOpen"); 
      $(menuContainer).removeClass("-mainMenuOpen"); 
      menuToggle.setAttribute( 'aria-expanded', 'false' );
      menuContainer.setAttribute( 'aria-expanded', 'false' );
    } else {
      // addClass(menuToggle, '-menuOpen'); 
      // addClass(menuContainer, '-mainMenuOpen');
      $(menuToggle).addClass("-menuOpen"); 
      $(menuContainer).addClass("-mainMenuOpen"); 
      menuToggle.setAttribute( 'aria-expanded', 'true' );
      menuContainer.setAttribute( 'aria-expanded', 'true' );
    }
    // // also close search
    // removeClass(searchToggle, '-menuOpen'); 
    // removeClass(searchContainer, '--mainMenuOpen');
    // searchToggle.setAttribute( 'aria-expanded', 'false' );
    // searchContainer.setAttribute( 'aria-expanded', 'false' );
  };


// when area OUTSIDE of menu/search is clicked, close and reset WAI-ARIA values 
  outsideMenu.onclick = function() {
  // close main nav 
    // removeClass(menuToggle, '-menuOpen'); 
    // removeClass(menuContainer, '-mainMenuOpen');
    $(menuToggle).removeClass("-menuOpen"); 
    $(menuContainer).removeClass("-mainMenuOpen"); 
    menuToggle.setAttribute( 'aria-expanded', 'false' );
    menuContainer.setAttribute( 'aria-expanded', 'false' );

  // // close search
  // removeClass(searchToggle, '-menuOpen'); 
  // removeClass(searchContainer, '--mainMenuOpen');
  // searchToggle.setAttribute( 'aria-expanded', 'false' );
  // searchContainer.setAttribute( 'aria-expanded', 'false' );
  };



// Reset mobile nav for laptop and desktop
  window.addEventListener('resize', disableMobileNav);
  function disableMobileNav() {
  // the innerWidth number is 1px less than laptop breakpoint set in src/scss/abstracts/variables.scss
    if (window.innerWidth > 1079) { 
      $(menuToggle).removeClass("-menuOpen"); 
      $(menuContainer).removeClass("-mainMenuOpen"); 
      menuToggle.setAttribute( 'aria-expanded', 'false' );
      menuContainer.setAttribute( 'aria-expanded', 'true' );
    } else {
      menuContainer.setAttribute( 'aria-expanded', 'false' );
    }
  }


})(jQuery);





// // variables for search toggle and content
// var searchContainer = document.querySelector('.site__search');
//     searchToggle = document.querySelector('.search-toggle');
//     searchClose = document.querySelector('.search-close');

//     // set WAI-ARIA values for search toggle
//     searchToggle.setAttribute( 'aria-expanded', 'false' );
//     searchContainer.setAttribute( 'aria-expanded', 'false' );









// // Toggle search and set WAI-ARIA values 
// searchToggle.onclick = function() {
//   if (hasClass(searchContainer, '--mainMenuOpen')) {
//     removeClass(searchToggle, '-menuOpen'); 
//     removeClass(searchContainer, '--mainMenuOpen');
//     searchToggle.setAttribute( 'aria-expanded', 'false' );
//     searchContainer.setAttribute( 'aria-expanded', 'false' );
//   } else {
//     addClass(searchToggle, '-menuOpen'); 
//     addClass(searchContainer, '--mainMenuOpen');
//     searchToggle.setAttribute( 'aria-expanded', 'true' );
//     searchContainer.setAttribute( 'aria-expanded', 'true' );
//   }
//     // also close main nav
//     removeClass(menuToggle, '-menuOpen'); 
//     removeClass(menuContainer, '-mainMenuOpen');
//     menuToggle.setAttribute( 'aria-expanded', 'false' );
//     menuContainer.setAttribute( 'aria-expanded', 'false' );
// };





// // Close search and reset WAI-ARIA values 
// searchClose.onclick = function() {
//   removeClass(searchContainer, '--mainMenuOpen');
//   removeClass(searchToggle, '-menuOpen');
//   searchToggle.setAttribute( 'aria-expanded', 'false' );
//   searchContainer.setAttribute( 'aria-expanded', 'false' );
// };








// console.log('menu controls loaded');