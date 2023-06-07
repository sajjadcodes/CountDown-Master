(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})(jQuery);





window.addEventListener("load", function () {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});

jQuery(document).ready(function (jQuery) {
	// Restore Defaults button click event
	jQuery('#wpct-restore-defaults').on('click', function () {
		// Confirm with the user before restoring defaults
		var confirmRestore = confirm('Are you sure you want to restore the defaults?');
		if (confirmRestore) {
			// Reset the input values to their default values
			jQuery('input[name="wpct_title_font_size"]').val('40px');
			jQuery('select[name="wpct_countdown_select_font"]').val('Roboto');
			jQuery('input[name="wpct_title_color"]').val('#00BF96');
			jQuery('input[name="wpct_title_weight"]').val('600');
			jQuery('input[name="wpct_title_line_height"]').val('1.3');
			jQuery('input[name="wpct_number_font_size"]').val('30px');
			jQuery('input[name="wpct_number_color"]').val('#ffffff');
			jQuery('input[name="wpct_number_bg_color"]').val('#00BF96');
			jQuery('input[name="wpct_number_weight"]').val('600');
			jQuery('input[name="wpct_number_line_height"]').val('1.3');
			jQuery('input[name="wpct_label_font_size"]').val('14px');
			jQuery('input[name="wpct_label_color"]').val('#ffffff');
			jQuery('input[name="wpct_label_weight"]').val('400');
			jQuery('input[name="wpct_label_line_height"]').val('1.3');
			jQuery('input[name="wpct_label_bg_color"]').val('#008044');
		}
	});
});

jQuery(document).ready(function (jQuery) {
	jQuery('#wpct-countdown-calendar').datepicker({
		dateFormat: 'yy-mm-dd', // Customize the date format as needed
		// Add any additional datepicker options here
		minDate: 0,
		onSelect: function (dateText, inst) {
			jQuery(this).val(dateText);
		}
	});

	jQuery('.wpct-calendar-trigger').click(function () {
		jQuery('#wpct-countdown-calendar').datepicker('show');
	});
});