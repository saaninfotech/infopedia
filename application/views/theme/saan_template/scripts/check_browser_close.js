/**
 * SAAN FRAMEWORK
 *
 * @project: Core Framework
 * @author: Saurabh Sinha
 * @created on: 7/2/13 8:13 PM
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

var validNavigation = false;

function endSession() {
    // Browser or broswer tab is closed
    // Do sth here ...
    alert("bye");
}

function wireUpEvents() {
    window.onbeforeunload = function() {
        if (!validNavigation) {
            endSession();
        }
    }

    /*
    // Attach the event keypress to exclude the F5 refresh
    $('document').bind('keypress', function(e) {
        if (e.keyCode == 116){
            validNavigation = true;
        }
    });

    // Attach the event click for all links in the page
    $("a").bind("click", function() {
        validNavigation = true;
    });

    // Attach the event submit for all forms in the page
    $("form").bind("submit", function() {
        validNavigation = true;
    });

    // Attach the event click for all inputs in the page
    $("input[type=submit]").bind("click", function() {
        validNavigation = true;
    });
    */

}

// Wire up the events as soon as the DOM tree is ready
$(document).ready(function() {
    wireUpEvents();
});
