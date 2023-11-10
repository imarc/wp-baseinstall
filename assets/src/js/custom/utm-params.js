/**
* UTM PARAM GRABBER
* Persistently keep UTM params in URL even after navigating to new page 
*/

(function($) {

  // UTM params 
  $(document).ready(function() {

    // let newParams = new URLSearchParams(document.location.search);
    // const paramArray = ['utm, campaignid, adgroupid, gclid, REFERRALCOD, RR_WCID, RR_WCID_TTLW'];
    // const hasParams = paramArray.reduce(
    //   (accumulator, currentValue) => accumulator || currentValue,
    //   false
    //   );
    // console.log(hasParams);

    var cr_req = window.location.href;
    var temp_params_string = '';
    var temp_params_parts = '';
    var temp_href = '';

    // If URL contains '?' and NOT '?s', get relevant UTM params and attach 
    // them to all links on page except those with the class .utmIgnoreLink 
    // The '?s' param is used by WordPress for search, so this is a compromise 
    // to get the search and UTM params to coexist without breaking one another 
    if( cr_req.search(/\?/) > -1 && cr_req.search(/\?s/) < 0 && ( // include '?' and exclude '?s'
        cr_req.search('utm') > -1 || 
        cr_req.search('campaignid') || 
        cr_req.search('adgroupid') || 
        cr_req.search('gclid') || 
        cr_req.search('REFERRALCOD') || 
        cr_req.search('RR_WCID') || 
        cr_req.search('RR_WCID_TTL') ) ) {

      var params = cr_req.split('?')[1];

      $("a:not('.utmIgnoreLink')").each(function() {
        if( $(this).attr('href') != '#' && $(this).attr('href') != null ) { 

          if( $(this).attr('href').search(/\?/) < 0 ) { // if URL doesn't have '?' params, add them 
            $(this).attr('href', $(this).attr('href') + '?' + params );
          } 

        }
        // alert($(this).attr('href'));
        // console.log('window param found');
      });
    }

  });

})(jQuery);



/**
* MARKETO FORM DATA SCRAPER - Part 1 of 2 
* This first script will check if the .mktoForm element exists, 
* and if it does, pull data from input fields in inputIds variable.
* Form used for testing is on https://www.baseinstall.com/get-quote/, but 
* this should work anywhere as long as the form class and input IDs match.
*/
window.onload = function() {
    // Check for the presence of .mktoForm div
    var mktoForm = document.querySelector('.mktoForm');

    if (!mktoForm) {
        return; // Exit the script if .mktoForm is not present
    }

    // Helper function to store values in localStorage
    function storeInLocalStorage(fieldName, fieldValue) {
        localStorage.setItem(fieldName, fieldValue);
        // console.log(fieldName + " stored in localStorage: " + fieldValue);
    }

    var inputIds = ["Email", "Phone", "FirstName", "LastName", "Company"]; // Ids for relevant fields 

    // For each input field, watch for changes and store the data for later use 
    inputIds.forEach(function(id) {
        var inputElement = document.getElementById(id);
        if (inputElement) {
            inputElement.addEventListener("change", function() {
                storeInLocalStorage(id, inputElement.value); 
                // console.log(id, inputElement.value); 
            });
        }
    });

    // Store all the form data in localStorage upon form submission
    mktoForm.addEventListener("submit", function() {
        inputIds.forEach(function(id) {
            var inputElement = document.getElementById(id);
            if (inputElement) {
                storeInLocalStorage(id, inputElement.value);
            }
        });
    });
}


/**
* MARKETO FORM DATA SCRAPER - Part 2 of 2 
* This second part needs to go on the destination page - currently this 
* uses a div that exists on https://www.baseinstall.com/thank-you/, but 
* provided the user doesn't close their browser or use incognito mode the 
* data pulled into localStorage from the first script should be available.
*/
window.onload = function() {
    var heroSection = document.getElementById('hero-block_3dbb2f2ef0130ffa53d23f2ef9ddc09a');

    if (!heroSection) {
        return; // Exit the script if #hero-section doesn't exist
    }

    // Helper function to retrieve values from localStorage
    function retrieveFromLocalStorage(fieldName) {
        return localStorage.getItem(fieldName);
    }

    var inputIds = ["Email", "Phone", "FirstName", "LastName", "Company"];
    var retrievedData = [];

    // Retrieve data from localStorage
    inputIds.forEach(function(id) {
        var value = retrieveFromLocalStorage(id);
        if (value) {
            retrievedData.push(id + ": " + value);
        }
    });

    // Create a new div inside #hero-block... 
    var newDataDiv = document.createElement('div');

    // Set the content of the new div using the retrieved data
    newDataDiv.innerHTML = retrievedData.join('<br>');

    // Set the div's style to display:none so it's not visible 
    newDataDiv.style.display = "none";

    // Append the new div to #hero-section
    heroSection.appendChild(newDataDiv);
}
