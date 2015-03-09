var LocationPicker = function(options) {
	this.options = $.extend({}, options);
	this.init(this.options);
	this.places = '';
	this.isInitialize = false;
};

LocationPicker.prototype.init = function(options) {
	this.initEvents();
};

LocationPicker.prototype.initEvents = function() {
	var _self = this;
	console.log('LocationPicker initEvents');
	$('#map-btn-ok').on('click', function(evt) {
		console.log('DOne select location');
		$('#location-picker').modal('hide');
	});
};

LocationPicker.prototype.initialize = function() {
	var _self = this;
	console.log('location initialie');
	_self.isInitialize = true;
	this.defaultLocation = new google.maps.LatLng(16.0466742, 108.206706);
	var mapOptions = {
		zoom : 12,
		mapTypeId : google.maps.MapTypeId.ROADMAP,
		center : this.defaultLocation
	};

	// the map object
	this.map = new google.maps.Map(document.getElementById('map-canvas'),
			mapOptions);
	// the marker object to draw on the map
	this.marker = new google.maps.Marker({
		position : this.defaultLocation,
		map : _self.map,
		draggable : true
	});

	// Create the search box and link it to the UI element.
	this.input = (document.getElementById('pac-input'));
	this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(this.input);

	this.searchBox = new google.maps.places.SearchBox((this.input));

	// pick list. Retrieve the matching places for that item.
	google.maps.event.addListener(_self.searchBox, 'places_changed',
			function() {
				_self.places = _self.searchBox.getPlaces();
				_self.map.setZoom(12);
				if (_self.places.length == 0) {
					return;
				}
				_self.updateChangedPlace(_self.places);
			});

	google.maps.event.addListener(_self.map, 'bounds_changed', function() {
		console.log('bounds change');
		var bounds = _self.map.getBounds();
		_self.searchBox.setBounds(bounds);
	});
	// drag marker event
	google.maps.event.addListener(_self.marker, 'dragend', function(evt) {
		console.log('drag here');
		_self.updateDataAfterDrag(_self.marker.getPosition());
	});

};

LocationPicker.prototype.geocodePosition = function(pos) {
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		latLng : pos
	}, function(responses) {
		if (responses && responses.length > 0) {
			// process data here, note that it will take time to get response
			// here
		} else {

		}
	});
};

LocationPicker.prototype.updateChangedPlace = function(places) {
	// get only first location
	var place = places[0];

	// reset marker
	this.marker.setMap(null);
	this.marker.setPosition(place.geometry.location);

	// animate the map
	this.map.panTo(place.geometry.location);
	this.marker.setMap(this.map);

	// update the current place
	this.places = place;
};

LocationPicker.prototype.updateDataAfterDrag = function(location) {
	var _self = this;
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		latLng : location
	}, function(responses) {
		if (responses && responses.length > 0) {
			// process data here
			console.log('drag here');
			_self.places = responses[0];
			_self.input.value = responses[0].formatted_address
		} else {
			_self.palces = '';
			console.log('no address for this location');
			_self.input.value = '';
		}
	});
};

LocationPicker.prototype.getSelectedLocation = function() {
	if (this.places) {
		return this.places;
	} else {
		return null;
	}
};

LocationPicker.prototype.reset = function() {
	this.map = null;
	this.searchBox = null;
	this.input = null;
};