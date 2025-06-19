function pmpromm_init_map(){

	var pmpromm_map_element = document.getElementById( 'pmpromm_map' );

    // If the map element doesn't exist, we can't do anything so return early.
	if( typeof pmpromm_map_element === 'undefined' ){
		return;
	}

	//Set your own start location for a map
	if( pmpromm_vars.override_first_marker_location === "1" ){
		var pmpromm_map_start = { lat: parseFloat( pmpromm_vars.default_start['lat'] ), lng: parseFloat( pmpromm_vars.default_start['lng'] ) };		
	} else {
		//If there isn't any pmpromm_markers, then use our default or override with the pmpromm_default_pmpromm_map_start filter
		var pmpromm_map_start = { lat: parseFloat( pmpromm_vars.default_start['lat'] ), lng: parseFloat( pmpromm_vars.default_start['lng'] ) };
		//Else, use the first pmpromm_marker that's loaded as the starting point
		if( typeof pmpromm_vars.marker_data !== 'undefined' && pmpromm_vars.marker_data.length > 0 ){
			if( pmpromm_vars.marker_data[0]['marker_meta']['lat'] !== null ){
				var pmpromm_map_start = { lat: parseFloat( pmpromm_vars.marker_data[0]['marker_meta']['lat'] ), lng: parseFloat( pmpromm_vars.marker_data[0]['marker_meta']['lng'] ) };
			}
		}
	}
	
	var pmpromm_map_arguments = {
		center: pmpromm_map_start,
		zoom: parseInt( pmpromm_vars.zoom_level ),
		maxZoom: pmpromm_vars.max_zoom
	};


	//Initiating the map
	var pmpro_map = new google.maps.Map( pmpromm_map_element, pmpromm_map_arguments);

	console.log( 'pmpromm_map_element', pmpromm_map);

	if( pmpromm_vars.map_styles !== "" ){
		pmpro_map.setOptions({ styles:  JSON.parse( pmpromm_vars.map_styles ) });
	}

	var pmpromm_infowindows = new Array();

	//Making sure we actually have pmpromm_markers
	if( typeof pmpromm_vars.marker_data !== 'undefined' ){

		for( pmpromm_marker_data_index = 0; pmpromm_marker_data_index < pmpromm_vars.marker_data.length; pmpromm_marker_data_index++ ){

			var pmpromm_latlng = { lat: parseFloat( pmpromm_vars.marker_data[pmpromm_marker_data_index]['marker_meta']['lat'] ), lng: parseFloat( pmpromm_vars.marker_data[pmpromm_marker_data_index]['marker_meta']['lng'] ) };

			var pmpromm_contentString = '<div id="pmpro_pmpromm_infowindow_'+pmpromm_marker_data_index+'" class="'+pmpromm_vars.infowindow_classes+'" style="width: 100%; max-width: '+pmpromm_vars.infowindow_width+'px;">'+
				'<div class="bodyContent">'+
				pmpromm_vars.marker_data[pmpromm_marker_data_index]['marker_content']+
				'</div>'+
			'</div>';

			var pmpromm_infowindow = new google.maps.InfoWindow({
				content: pmpromm_contentString
			});

			pmpromm_infowindows.push( pmpromm_infowindow );

			var pmpromm_marker = new google.maps.Marker({
				position: pmpromm_latlng,
				map: pmpro_map,
				content: pmpromm_contentString,
				pmpromm_infowindow: pmpromm_infowindow
			});

			google.maps.event.addListener( pmpromm_marker,'click', (function(pmpromm_marker,content,pmpromm_infowindow){ 
			    return function() {
			    	//Close all other pmpromm_infowindows before we open a new one
			    	for( pmpromm_marker_window_index = 0; pmpromm_marker_window_index < pmpromm_infowindows.length; pmpromm_marker_window_index++ ){
			    		pmpromm_infowindows[pmpromm_marker_window_index].close();
			    	}
			        pmpromm_infowindow.setContent(this.content);
			        pmpromm_infowindow.open(pmpro_map,pmpromm_marker);
			    };
			})(pmpromm_marker,pmpromm_contentString,pmpromm_infowindow));  

			
		}

	}

};
