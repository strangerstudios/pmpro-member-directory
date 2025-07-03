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
	
	var pmpromd_map_arguments = {
		center: pmpromd_map_start,
		zoom: parseInt( pmpromd_vars.zoom_level ),
		maxZoom: pmpromd_vars.max_zoom
	};


	//Initiating the map
	var pmpro_map = new google.maps.Map( pmpromd_map_element, pmpromd_map_arguments);

	if( pmpromd_vars.map_styles !== "" ){
		pmpro_map.setOptions({ styles:  JSON.parse( pmpromd_vars.map_styles ) });
	}

	var pmpromd_infowindows = new Array();

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

			var pmpromd_marker = new google.maps.Marker({
				position: pmpromd_latlng,
				map: pmpro_map,
				content: pmpromd_contentString,
				pmpromd_infowindow: pmpromd_infowindow
			});

			google.maps.event.addListener( pmpromd_marker,'click', (function(pmpromd_marker,content,pmpromd_infowindow){ 
			    return function() {
			    	//Close all other pmpromd_infowindows before we open a new one
			    	for( pmpromd_marker_window_index = 0; pmpromd_marker_window_index < pmpromd_infowindows.length; pmpromd_marker_window_index++ ){
			    		pmpromd_infowindows[pmpromd_marker_window_index].close();
			    	}
			        pmpromd_infowindow.setContent(this.content);
			        pmpromd_infowindow.open(pmpro_map,pmpromd_marker);
			    };
			})(pmpromd_marker,pmpromd_contentString,pmpromd_infowindow));  

			
		}

	}

};
