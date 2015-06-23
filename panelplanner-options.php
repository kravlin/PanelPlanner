<?php

function panel_planner_gen_options_page(){
	if( !current_user_can( 'manage_options') ){
		wp_die( __( 'You do not have permission to access this page.') );
	}
	echo "This is the song that gets on everybody's nerves\n";

	echo panel_planner_display_panels();

}

function panel_planner_display_panels(){
	global $wpdb;
	$tableName = $wpdb->prefix . "panelPlanner_panels";
	$panels = $wpdb->get_results( 'SELECT * from '.$tableName);
	foreach($panels as $panel){
		echo $panel;
	}
	echo "DERPDERPDERP\n";
}

function panel_planner_accept_panel(){
	echo "SlurpSlurpSlurp\n";
}

function panel_planner_deny_panel(){
	echo "BurpBurpBurp\n";
}

?>