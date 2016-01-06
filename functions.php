<?php
	function scripts_and_styles() {
		wp_register_style( 'brown', network_site_url() . 'wp-content/themes/frontier_shores/webfonts/brown/stylesheet.css' );
		wp_register_style( 'grouch', network_site_url() . 'wp-content/themes/frontier_shores/webfonts/grouch/MyFontsWebfontsKit.css' );
		wp_register_style( 'jQueryUI', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );
		wp_register_style( 'mainStyles', network_site_url() . 'wp-content/themes/frontier_shores/css/style.css' );
		
		wp_enqueue_style( 'brown', network_site_url() . 'wp-content/themes/frontier_shores/webfonts/brown/stylesheet.css' );
		wp_enqueue_style( 'grouch', network_site_url() . 'wp-content/themes/frontier_shores/webfonts/grouch/MyFontsWebfontsKit.css' );
		wp_enqueue_style( 'jQueryUI', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );
		wp_enqueue_style( 'mainStyles', network_site_url() . 'wp-content/themes/frontier_shores/css/style.css' );



		wp_register_script( 'jQuery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4', false );
		wp_register_script( 'jQueryUI', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', false, '1.11.4', false );
		wp_register_script( 'jQueryColor', network_site_url() . 'js/min/jquery.color-2.1.2-min.js', false, '2.1.2', false );
		wp_register_script( 'shadow', network_site_url() . 'js/min/jquery.animate-shadow-min.js', false, '', false );
		wp_register_script( 'columnizer', network_site_url() . 'js/min/jquery.columnizer-min.js', false, '', false );
		wp_register_script( 'frontiershores', network_site_url() . 'wp-content/themes/frontier_shores/js/min/fs-min.js', false, '1.0', false );


		wp_enqueue_script( 'jQuery' );
		wp_enqueue_script( 'jQueryUI' );
		wp_enqueue_script( 'jQueryColor', network_site_url() . 'js/min/jquery.color-2.1.2-min.js', false, '2.1.2', false );
		wp_enqueue_script( 'shadow', network_site_url() . 'js/min/jquery.animate-shadow-min.js', false, '', false );
		wp_enqueue_script( 'columnizer', network_site_url() . 'js/min/jquery.columnizer-min.js', false, '', false );
		wp_enqueue_script( 'frontiershores', network_site_url() . 'wp-content/themes/frontier_shores/js/min/fs-min.js', false, '1.0', false );

	}
	add_action ('wp_enqueue_scripts', 'scripts_and_styles');
?>