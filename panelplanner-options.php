<?php

function panel_planner_gen_options_page(){
	if( !current_user_can( 'manage_options') ){
		wp_die( __( 'You do not have permission to access this page.') );
	}
	echo '<div class="wrap">';
	echo '<p>Options will eventually go here.</p>';
	echo '</div>';
}

?>