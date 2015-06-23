<?php

function panel_planner_gen_options_page(){
	if( !current_user_can( 'manage_options') ){
		wp_die( __( 'You do not have permission to access this page.') );	
	}else{
		if ( isset($_POST['pp-accept']) ) {
			self::panel_planner_accept_panel();
		} 	
		elseif ( isset($_POST['pp-deny']) ) {
			self::panel_planner_deny_panel();
		} 	
	}
		echo panel_planner_display_panels($stage);
}

function panel_planner_display_panels($stage){
	global $wpdb;
	echo "<br><br>";
	echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post" role="form">';
	$tableName = $wpdb->prefix . "panelPlanner_panels";
	$panels = $wpdb->get_results('SELECT * from '.$tableName);
	echo "<table>";
	echo "<td><b>Panel ID</b></td>";
	echo "<td><b>Panel Title</b></td>";
	echo "<td><b>Description</b></td>";
	echo "<td><b>Panelist Name</b></td>";
	echo "<td><b>Select Panel</b></td>";
	foreach($panels as $panel){
		echo "<tr>";
		panel_planner_print_panel($panel);
		echo "</tr>";
	}
	echo "</table>";
	echo '<textarea class="form-control" rows="10" cols="35" name="pp-denial-reason" placeholder="Denial Reason"></textarea><br>';
	echo '<input type="submit" name="pp-accept" value="accept"/>';
	echo '<input type="submit" name="pp-deny" value="deny"/>';

	echo "</form>";
}
/*id mediumint(9) AUTO_INCREMENT PRIMARY KEY,
panelistID mediumint(9) NOT NULL,
copanelistID mediumint(9),
title varchar(50) NOT NULL,
description varchar(5000) NOT NULL,
outline varchar(5000) NOT NULL,
approvalStage int NOT NULL,
rejectionReason varchar(500) NOT NULL
*/
//I know tables are a SHITTY way to do this, and are like the cardinal sin of web design, but it's fast and dirty.
function panel_planner_print_panel($panel){
	global $wpdb;
	$tableName = $wpdb->prefix . "panelPlanner_panelists";
	echo "<td>".$panel->id."</td>";
	echo "<td>".$panel->title."</td>";
	echo "<td>".$panel->description."</td>";
	$panelist = $wpdb->get_row("SELECT * FROM ".$tableName." WHERE id = ".$panel->panelistID);
	echo "<td>".$panelist->firstName." ".$panelist->lastName."</td>";
	echo '<td><input type="radio" name="'.$panel->id.'" value="'.$panel->id.'"><br>';

}

function panel_planner_accept_panel(){
	echo "SlurpSlurpSlurp\n";
}

function panel_planner_deny_panel(){
	echo "BurpBurpBurp\n";
}

?>