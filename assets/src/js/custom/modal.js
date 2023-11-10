/**
* MODAL POPUP
* Plain JavaScript pop up window, no jQuery required
*/


var modalPopupWindow = document.getElementById('modal-block');

// Get the button that opens the modal
var modalPopupOpen = document.getElementById("modal-button");

// Get the <span> element that closes the modal
var modalPopupClose = document.getElementsByClassName("close")[0];



if (typeof(modalPopupWindow) != 'undefined' && modalPopupWindow != null) {

	// When the user clicks the button, open the modal 
	modalPopupOpen.onclick = function() {
	    modalPopupWindow.style.display = "block";
	    addClass(modalPopupWindow, 'toggled');
	};

	// When the user clicks on <span> (x), close the modal
	modalPopupClose.onclick = function() {
	  modalPopupWindow.style.display = "none";
	  removeClass(modalPopupWindow, 'toggled');
	};

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modalPopupWindow) {
	    modalPopupWindow.style.display = "none";
	    removeClass(modalPopupWindow, 'toggled');
	  }
	};

} else {
	// Nothing
}



// // // Find all instances of .gallery
// // var baguetteBoxGallery = document.getElementsByClassName('gallery');

// // // Iterate through all instances of .gallery to add .baguetteBox
// // for (var i = 0; i < baguetteBoxGallery.length; i++) {
// //     // add the unique class to eliminate conflicts with multiple galleries
// //     baguetteBoxGallery[i].classList.add("baguetteBox" + (i+1));
// // }

// // // Run up to 3 instances of slideshow on a single page
// // // Follow the pattern to have more or less if needed
// // var baguetteBoxOne = document.getElementsByClassName('baguetteBox1');
// // if (baguetteBoxOne.length > 0) {
// //     baguetteBox.run('.baguetteBox1');
// // }

// // var baguetteBoxTwo = document.getElementsByClassName('baguetteBox2');
// // if (baguetteBoxTwo.length > 0) {
// //     baguetteBox.run('.baguetteBox2');
// // }

// // var baguetteBoxThree = document.getElementsByClassName('baguetteBox3');
// // if (baguetteBoxThree.length > 0) {
// //     baguetteBox.run('.baguetteBox3');
// // }

// // var baguetteBoxFour = document.getElementsByClassName('baguetteBox4');
// // if (baguetteBoxFour.length > 0) {
// //     baguetteBox.run('.baguetteBox4');
// // }




// console.log('modal loaded');