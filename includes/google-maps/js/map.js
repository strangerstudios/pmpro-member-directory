function pmpromd_init_map(){

	var pmpromd_map_element = document.getElementById( 'pmpromd_map' );

    // If the map element doesn't exist, we can't do anything so return early.
	if( typeof pmpromd_map_element === 'undefined' ){
		return;
	}

	//Set your own start location for a map
	if( pmpromd_vars.override_first_marker_location === "1" ){
		var pmpromd_map_start = { lat: parseFloat( pmpromd_vars.default_start['lat'] ), lng: parseFloat( pmpromd_vars.default_start['lng'] ) };		
	} else {
		//If there isn't any pmpromd_markers, then use our default or override with the pmpromd_default_pmpromd_map_start filter
		var pmpromd_map_start = { lat: parseFloat( pmpromd_vars.default_start['lat'] ), lng: parseFloat( pmpromd_vars.default_start['lng'] ) };
		//Else, use the first pmpromd_marker that's loaded as the starting point
		if( typeof pmpromd_vars.marker_data !== 'undefined' && pmpromd_vars.marker_data.length > 0 ){
			if( pmpromd_vars.marker_data[0]['marker_meta']['lat'] !== null ){
				var pmpromd_map_start = { lat: parseFloat( pmpromd_vars.marker_data[0]['marker_meta']['lat'] ), lng: parseFloat( pmpromd_vars.marker_data[0]['marker_meta']['lng'] ) };
			}
		}
	}

	// The newer AdvancedMarkerElement needs a Google Map ID and the marker library. When either one is
	//  missing we fall back to the classic markers so the map still renders.
	var pmpromd_google_map_id = typeof pmpromd_vars.google_map_id === 'undefined' ? '' : pmpromd_vars.google_map_id;
	var pmpromd_use_advanced_markers = pmpromd_google_map_id !== ''
		&& typeof google.maps.marker !== 'undefined'
		&& typeof google.maps.marker.AdvancedMarkerElement !== 'undefined';

	var pmpromd_map_arguments = {
		center: pmpromd_map_start,
		zoom: parseInt( pmpromd_vars.zoom_level ),
		maxZoom: pmpromd_vars.max_zoom
	};

	if( pmpromd_use_advanced_markers ){
		pmpromd_map_arguments.mapId = pmpromd_google_map_id;
	}

	//Initiating the map
	var pmpro_map = new google.maps.Map( pmpromd_map_element, pmpromd_map_arguments);

	// A Map ID pulls its styling from the Google Cloud console, so the JSON styles only apply to maps
	//  without one. Setting both logs a warning and the JSON styles get ignored anyway.
	if( ! pmpromd_use_advanced_markers && pmpromd_vars.map_styles !== "" ){
		pmpro_map.setOptions({ styles:  JSON.parse( pmpromd_vars.map_styles ) });
	}

	var pmpromd_infowindows = new Array();
	
	// Array to store all markers for clustering
	var pmpromd_markers = new Array();

	// Place the markers on the map one by one. Advanced markers are placed by setting the `map` property.
	var pmpromd_place_markers = function() {
		for ( var pmpromd_marker_index = 0; pmpromd_marker_index < pmpromd_markers.length; pmpromd_marker_index++ ) {
			if( pmpromd_use_advanced_markers ){
				pmpromd_markers[pmpromd_marker_index].map = pmpro_map;
			} else {
				pmpromd_markers[pmpromd_marker_index].setMap( pmpro_map );
			}
		}
	};

	//Making sure we actually have pmpromd_markers
	if( typeof pmpromd_vars.marker_data !== 'undefined' ){

		for( pmpromd_marker_data_index = 0; pmpromd_marker_data_index < pmpromd_vars.marker_data.length; pmpromd_marker_data_index++ ){

			var pmpromd_latlng = { lat: parseFloat( pmpromd_vars.marker_data[pmpromd_marker_data_index]['marker_meta']['lat'] ), lng: parseFloat( pmpromd_vars.marker_data[pmpromd_marker_data_index]['marker_meta']['lng'] ) };

			var pmpromd_contentString = '<div id="pmpro_pmpromd_infowindow_'+pmpromd_marker_data_index+'" class="'+pmpromd_vars.infowindow_classes+'" style="width: 100%; max-width: '+pmpromd_vars.infowindow_width+'px;">'+
				'<div class="bodyContent">'+
				pmpromd_vars.marker_data[pmpromd_marker_data_index]['marker_content']+
				'</div>'+
			'</div>';

			var pmpromd_infowindow = new google.maps.InfoWindow({
				content: pmpromd_contentString
			});

			pmpromd_infowindows.push( pmpromd_infowindow );

			var pmpromd_marker;

			if( pmpromd_use_advanced_markers ){
				pmpromd_marker = new google.maps.marker.AdvancedMarkerElement({
					position: pmpromd_latlng,
					gmpClickable: true
				});
			} else {
				pmpromd_marker = new google.maps.Marker({
					position: pmpromd_latlng,
					content: pmpromd_contentString,
					pmpromd_infowindow: pmpromd_infowindow
				});
			}

			//Click handler shared by both marker types
			var pmpromd_marker_click_handler = (function(pmpromd_marker,content,pmpromd_infowindow){ 
			    return function() {
			    	//Close all other pmpromd_infowindows before we open a new one
			    	for( pmpromd_marker_window_index = 0; pmpromd_marker_window_index < pmpromd_infowindows.length; pmpromd_marker_window_index++ ){
			    		pmpromd_infowindows[pmpromd_marker_window_index].close();
			    	}
			        pmpromd_infowindow.setContent(content);
			        if( pmpromd_use_advanced_markers ){
			        	pmpromd_infowindow.open({ map: pmpro_map, anchor: pmpromd_marker });
			        } else {
			        	pmpromd_infowindow.open(pmpro_map,pmpromd_marker);
			        }
			    };
			})(pmpromd_marker,pmpromd_contentString,pmpromd_infowindow);

			if( pmpromd_use_advanced_markers ){
				pmpromd_marker.addEventListener( 'gmp-click', pmpromd_marker_click_handler );
			} else {
				google.maps.event.addListener( pmpromd_marker,'click', pmpromd_marker_click_handler );
			}

			// Add marker to the array instead of directly to the map
			pmpromd_markers.push(pmpromd_marker);
		}

		// Only show clusters if PHP filter is enabled. 
		if ( pmpromd_vars.show_cluster === true || pmpromd_vars.show_cluster === "1" || pmpromd_vars.show_cluster === 1 ) {
			if( typeof markerClusterer !== 'undefined' && typeof markerClusterer.MarkerClusterer !== 'undefined' ) {
				// The clusterer adds the markers to the map and picks the matching marker type for us.
				new markerClusterer.MarkerClusterer({
					map: pmpro_map,
					markers: pmpromd_markers
				});
			} else {
				// Place all markers on the map if the clusterer library did not load.
				pmpromd_place_markers();
			}
		} else {
			// Place all markers on the map (fallback if clustering is disabled).
			pmpromd_place_markers();
		}
	}

};
