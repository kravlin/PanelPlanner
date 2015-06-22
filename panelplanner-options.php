<?php

function panel_planner_gen_options_page(){
	if( !current_user_can( 'manage_options') ){
		wp_die( __( 'You do not have permission to access this page.') );
	}
	echo "This is the song that gets on everybody's nerves";

	echo panel_planner_display_panels();

}

function panel_planner_display_panels(){
	global $wpdb;
	echo "DERPDERPDERP";
}

function panel_planner_accept_panel(){
	echo "SlurpSlurpSlurp";
}

function panel_planner_deny_panel(){
	echo "BurpBurpBurp";
}

?>