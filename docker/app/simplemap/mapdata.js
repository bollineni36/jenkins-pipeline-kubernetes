var simplemaps_usmap_mapdata = {

	main_settings:{
		//General settings
		width: '700', //or 'responsive'
		background_color: '#FFFFFF',	
		background_transparent: 'no',
		border_color: '#ffffff',
		pop_ups: 'detect', //on_click, on_hover, or detect
	
		//State defaults
		state_description:   'State description',
		state_color: '#88A4BC',
		state_hover_color: '#3B729F',
		state_url: 'http://simplemaps.com',
		border_size: 1.5,		
		all_states_inactive: 'no',
		all_states_zoomable: 'no',		
		
		//Location defaults
		location_description:  'Location description',
		location_color: '#FF0067',
		location_opacity: .8,
		location_hover_opacity: 1,
		location_url: '',
		location_size: 25,
		location_type: 'square', // circle, square, image
		location_image_source: 'frog.png', //name of image in the map_images folder		
		location_border_color: '#FFFFFF',
		location_border: 2,
		location_hover_border: 2.5,				
		all_locations_inactive: 'no',
		all_locations_hidden: 'no',
		
		//Labels
		label_color: '#d5ddec',	
		label_hover_color: '#d5ddec',		
		label_size: 22,
		label_font: 'Arial',
		hide_labels: 'no',
		hide_eastern_labels: 'no',
		
		//Zoom settings
		zoom: 'yes', //use default regions		
		back_image: 'no',   //Use image instead of arrow for back zoom				
		arrow_color: '#3B729F',
		arrow_color_border: '#88A4BC',
		initial_back: 'no', //Show back button when zoomed out and do this JavaScript upon click		
		initial_zoom: -1,  //-1 is zoomed out, 0 is for the first continent etc	
		initial_zoom_solo: 'no', //hide adjacent states when starting map zoomed in
		region_opacity: 1,
		region_hover_opacity: .6,
		zoom_out_incrementally: 'yes',  // if no, map will zoom all the way out on click
		zoom_percentage: .99,
		zoom_time: .5, //time to zoom between regions in seconds
		
		//Popup settings
		popup_color: 'white',
		popup_opacity: .9,
		popup_shadow: 1,
		popup_corners: 5,
		popup_font: '12px/1.5 Verdana, Arial, Helvetica, sans-serif',
		popup_nocss: 'no', //use your own css	
		
		//Advanced settings
		div: 'maps',
		auto_load: 'yes',		
		url_new_tab: 'no', 
		images_directory: 'default', //e.g. 'map_images/'
		fade_time:  .1, //time to fade out		
		link_text: '(Link)'  //Text mobile browsers will see for links	
		
	},

	state_specific:{	
		"HI": {
			name: 'Hawaii',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Hawaii'
		},
		"AK": {
			name: 'Alaska',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Alaska'
			},
		"FL": {
			name: 'Florida',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Florida',
			inactive: 'no'
			},
		"NH": {
			name: 'New Hampshire',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=New Hampshire'
			},
		"VT": {
			name: 'Vermont',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Vermont'
			},
		"ME": {
			name: 'Maine',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Maine'	
			},
		"RI": {
			name: 'Rhode Island',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Rhode Island'		
			},
		"NY": {
			name: 'New York',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=New York'	
		},
		"PA": {
			name: 'Pennsylvania',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Pennsylvania'				
			},
		"NJ": {
			name: 'New Jersey',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=New Jersey'
			},
		"DE": {
			name: 'Delaware',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Delaware'			
			},
		"MD": {
			name: 'Maryland',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Maryland'						
			},
		"VA": {
			name: 'Virginia',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Virginia'			
			},
		"WV": {
			name: 'West Virginia',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=West Virginia'				
			},
		"OH": {
			name: 'Ohio',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Ohio'		
			},
		"IN": {
			name: 'Indiana',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Indiana'				
			},
		"IL": {
			name: 'Illinois',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Illinois'			
			},
		"CT": {
			name: 'Connecticut',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Connecticut'				
			},
		"WI": {
			name: 'Wisconsin',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Wisconsin'			
			},
		"NC": {
			name: 'North Carolina',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=North Carolina'			
			},
		"DC": {
			name: 'District of Columbia',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=District of Columbia'
		},
		"MA": {
			name: 'Massachusetts',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Massachusetts'				
			},
		"TN": {
			name: 'Tennessee',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Tennessee'		
			},
		"AR": {
			name: 'Arkansas',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Arkansas'			
			},
		"MO": {
			name: 'Missouri',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Missouri'			
			},
		"GA": {
			name: 'Georgia',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Georgia'			
			},
		"SC": {
			name: 'South Carolina',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=South Carolina'			
			},
		"KY": {
			name: 'Kentucky',
			description: 'default',
			color: 'default',
			zoomable: 'no',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Kentucky'			
			},
		"AL": {
			name: 'Alabama',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Alabama'					
			},
		"LA": {
			name: 'Louisiana',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Louisiana'			
			},
		"MS": {
			name: 'Mississippi',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Mississippi'				
			},
		"IA": {
			name: 'Iowa',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Iowa'			
			},
		"MN": {
			name: 'Minnesota',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Minnesota'
			},
		"OK": {
			name: 'Oklahoma',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Oklahoma'			
			},
		"TX": {
			name: 'Texas',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Texas'			
			},
		"NM": {
			name: 'New Mexico',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=New Mexico'		
			},
		"KS": {
			name: 'Kansas',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Kansas'			
			},
		"NE": {
			name: 'Nebraska',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Nebraska'		
			},
		"SD": {
			name: 'South Dakota',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=South Dakota'
			},
		"ND": {
			name: 'North Dakota',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=North Dakota'
			},
		"WY": {
			name: 'Wyoming',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Wyoming'
			},
		"MT": {
			name: 'Montana',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Montana'
			},
		"CO": {
			name: 'Colorado',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Colorado'
			},
		"UT": {
			name: 'Utah',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Utah'
			},
		"AZ": {
			name: 'Arizona',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Arizona'
			},
		"NV": {
			name: 'Nevada',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Nevada'		
			},
		"OR": {
			name: 'Oregon',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Oregon'		
			},
		"WA": {
			name: 'Washington',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Washington'				
			},
		"CA": {
			name: 'California',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=California'					
			},
		"MI": {
			name: 'Michigan',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Michigan'				
			},
		"ID": {
			name: 'Idaho',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Idaho'
			},
		// Territories - Hidden unless hide is set to "no"
		"GU": {
			name: 'Guam',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Guam',
			hide: 'yes'
			},
		"VI": {
			name: 'Virgin Islands',
			image_source: 'x.png',			
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Virgin Islands',
			hide: 'yes'
			},
		"PR": {
			name: 'Puerto Rico',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Puerto Rico',
			hide: 'yes'
			},
		"MP": {
			name: 'Northern Mariana Islands',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'http://www.konsear.com/state_offer_details.php?st=Northern Mariana Islands',
			hide: 'yes'
			}		
		},
	
	/*locations:{
		"0": { //must give each location an id, so that you can reference it later
			name: "New York",
			lat: 40.71, 
			lng: -74.00,
			description: 'default',
			color: 'default',
			url: 'default',
			type: 'default',
			size: 'default' //Note:  You must omit the comma after the last property in an object to prevent errors in internet explorer.
		},
		1: {
			name: 'Anchorage',
			lat: 61.2180556,
			lng: -149.9002778, 
			color: 'default',
			type: 'circle'
		}
	},
	
	labels:{
		"HI": {
			color: 'default',
			hover_color: 'default',
			font_family: 'default',
			pill: 'yes',	
			width: 'default',			
		}
	}*/
	
}




