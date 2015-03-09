/**
 * This is map.js
 */
$(document).ready(function() {
	// init map
	//$('#mapModal').on('shown.bs.modal', function(e) {
		var locationPicker = new LocationPicker();
		console.log('here');
		google.maps.event.addDomListener(window, 'load', locationPicker.initialize());
	//});
	$('#mapModal').on('hide.bs.modal', function(e) {
		//
	});
});