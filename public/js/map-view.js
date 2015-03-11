var MapView = function(delegate, options) {
    this.delegate = delegate;
    this.options = $.extend({}, options);
    if (!this.options.location) {
        // the default location
        this.options.location = {
            'lat': 16.0466742,
            'lng': 108.206706
        };
    }
    this.containerView = $('.map-view-container');
    this.isInitialize = false;
    this.init(this.options);
};
MapView.prototype = {
    init: function(options) {
        //this.initMapView();
    },
    initMapView: function() {
        var _self = this;
        this.isInitialize = true;
        this.defaultLocation = new google.maps.LatLng(_self.options.location.lat, _self.options.location.lng);
        var mapOptions = {
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: this.defaultLocation
        };
        // the map object
        this.map = new google.maps.Map(document.getElementById('map-view-canvas'), mapOptions);
        // the marker object to draw on the map
        this.marker = new google.maps.Marker({
            position: this.defaultLocation,
            map: _self.map
        });
    },
    panMapTo: function(location) {
        var newLocation = new google.maps.LatLng(location.lat, location.lng);
        // reset marker
        this.marker.setMap(null);
        this.marker.setPosition(newLocation);
        // animate the map
        this.map.panTo(newLocation);
        this.marker.setMap(this.map);
    },
    appendMapViewTo: function($container) {
        if ($container.length) {
            $container.append(this.containerView);
        }
    }
};