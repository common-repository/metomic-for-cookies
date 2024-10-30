(function( $ ) {
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
	var baseUri = 'https://app.metomic.io';

	function setProjectId(data) {
		if (data.projectId) {
			$('#metomic-connect [name="mtm_project_id"]').val(data.projectId)
			$("#metomic-connect").submit();
		}
	}

	var siteUrl = $('#site-url').val()

	$( window ).load(function(e) {
		$("#connect-metomic-account").click(function(){
			e.preventDefault();
			awaitCallback(setProjectId)
			window.open(baseUri+'/connect?client=wp&context=connect', 'loading...', 'width=600,height=725');
			return false;
		});

		$("#create-metomic-account").click(function(e){
			e.preventDefault();
			awaitCallback(setProjectId)
			window.open(baseUri+'/connect?client=wp&context=create&site-url='+siteUrl, 'loading...');
			return false;
		});
	})

	function awaitCallback(cb) {
		var done
		function receiveMessage(event) {
			if (event.origin !== baseUri) return
	
			let obj
			try {
				obj = JSON.parse(event.data)
			} catch (e) {
				//
			}
			if (!obj) return
			cb(obj)
			if (done) {
				done()
			}
		}

		done = window.addEventListener("message", receiveMessage, false);
	}

})( jQuery );
