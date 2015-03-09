/**
 * This is map.js
 */
jQuery(document)
		.ready(
				function($) {
					var locationPicker = new LocationPicker();
					// init map
					//if (locationPicker) {
					//	locationPicker.initialize();
					//}
					$('#location-picker').on('shown.bs.modal', function(e) {
						if (!locationPicker.isInitialize) {
							console.log('hererere');
							locationPicker.initialize();
						} else {
							console.log('initialized');
						}
					});
					$('#location-picker')
							.on(
									'hide.bs.modal',
									function(e) {
										//
										console.log('hide dialog');
										console.log(locationPicker
												.getSelectedLocation());
										if (locationPicker
												.getSelectedLocation()) {
											console.log('iffff');
											$('#location-selected')
													.val(
															locationPicker
																	.getSelectedLocation().formatted_address);
										}
									});
					function loadScript() {
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp'
								+ '&signed_in=true&libraries=places&callback=initLocationPicker';
						document.body.appendChild(script);
						console.log('here man');
					}
					;

					function initLocationPicker() {
						var locationPicker = new LocationPicker();
						console.log('here');
						locationPicker.initialize();
						// google.maps.event.addDomListener(window,
						// 'load', locationPicker.initialize());
					}
					;
				});