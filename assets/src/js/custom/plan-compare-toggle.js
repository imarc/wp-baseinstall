/**
* PLAN COMPARISON BLOCK TOGGLE 
* Show/hide plan comparison chart and set WAI-ARIA values when toggle is clicked
* This is specific to the plan comparison block 
*/

(function($) {

var planComparisonToggle = document.querySelector('#planComparisonToggle');
    planComparisonDetails = document.querySelectorAll('.planComparison__chartDetails');
    planComparisonToggleText = document.querySelector('.planComparison__toggleText');

// make sure elements exist, then do stuff 
if (typeof(planComparisonToggle) != 'undefined' && planComparisonToggle != null) {

  // set WAI-ARIA values for plan comparison chart 
  planComparisonToggle.setAttribute( 'aria-expanded', 'false' );
  planComparisonDetails.forEach(el => {el.setAttribute( 'aria-expanded', 'false' );})

  planComparisonToggle.onclick = function() {

    if ($(planComparisonToggle).hasClass('-comparisonOpen')) {
      $(planComparisonToggle).removeClass("-comparisonOpen"); // update toggle button class 
      planComparisonToggle.setAttribute( 'aria-expanded', 'false' ); // update toggle button aria attribute 
      planComparisonDetails.forEach(el => {el.classList.remove('-comparisonOpen');}); // update class on details container 
      planComparisonDetails.forEach(el => {el.setAttribute( 'aria-expanded', 'false' );}); // update aria for details containe

      planComparisonToggleText.innerHTML = "Show detailed plan comparison"; 
    } else {
      $(planComparisonToggle).addClass("-comparisonOpen"); // update toggle button class 
      planComparisonToggle.setAttribute( 'aria-expanded', 'true' ); // update toggle button aria attribute 
      planComparisonDetails.forEach(el => {el.classList.add('-comparisonOpen');}); // update class on details container 
      planComparisonDetails.forEach(el => {el.setAttribute( 'aria-expanded', 'true' );}); // update aria for details container 

      planComparisonToggleText.innerHTML = "Hide detailed plan comparison";
    }
  };
}

})(jQuery);
