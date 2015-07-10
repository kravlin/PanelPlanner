<?php
/**
 Plugin Name: Panel Planner
 Plugin URI: http://chronostasis.net/PanelPlanner
 Description: A plugin used to help accept and deny panels for conventions
 Version: 1.0
 Author: Kravlin
 Author URI: http://chronostasis.net
 Network: False
 License: GNU Public License 2
 Copyright 2015  Kravlin  (email : kravlin@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/

//Includes!

include dirname(__FILE__) .'/panelplanner_stage1.php';
include dirname(__FILE__) .'/panelplanner_stage2.php';
include dirname(__FILE__) .'/panelplanner-options.php';

//Global Variables!



/**
function panel_planner_build_form($fname){
    $toReturn = file_get_contents(dirname(__FILE__).'/'.$fname);
    return $toReturn;
}
**/

function install_database(){

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

	//Create Database Tables

	global $wpdb;
	$panelplanner_db_version = "1.0";
	$charset_collate = $wpdb->get_charset_collate();

	//Create Panelists Table
	
	error_log("creating panelists table");
	$create_panelists = "CREATE TABLE ".$wpdb->prefix."panelPlanner_panelists (
id int AUTO_INCREMENT PRIMARY KEY,
firstName varchar(20) NOT NULL,
lastName varchar(20) NOT NULL,
email varchar(50) NOT NULL,
age int NOT NULL
)".$charset_collate.";";

	dbDelta( $create_panelists );
	error_log("panelists table should be created");

	//Create Panels Table

	error_log("creating panel table");
	$create_panels = "CREATE TABLE ".$wpdb->prefix."panelPlanner_panels (
id mediumint(9) AUTO_INCREMENT PRIMARY KEY,
panelistID mediumint(9) NOT NULL,
copanelistID mediumint(9),
title varchar(50) NOT NULL,
description varchar(5000) NOT NULL,
outline varchar(5000) NOT NULL,
approvalStage int NOT NULL,
rejectionReason varchar(500) NOT NULL,
panelID varchar(32),
read_guidelines mediumint(9),
scheduling varchar(5000)
)".$charset_collate.";";

	dbDelta( $create_panels );
	error_log("panel table should be created");
	add_option( 'panelplanner_db_version' , $panelplanner_db_version);
	error_log("Adding panel IDs in for stage 2");
	panel_planner_add_PanelIDs();
	error_log("Panel IDs added for stage 2");

}

function panel_planner_add_PanelIDs(){
	global $wpdb;
    $tableName = $wpdb->prefix . "panelPlanner_panels";	
    $panels = $wpdb->get_results('SELECT * from '.$tableName.' WHERE PanelID IS NULL');
    error_log(count($panels)." were found that needs PanelIDs");
    foreach($panels as $panel){
    	$ID = $panel->id;
    	$panelID = substr(md5(microtime()),rand(0,26),32);
    	error_log("Adding panelID: ".$panelID." for panel #: ".$ID);
    	$wpdb->update( 
    		$tableName,
    		array( 'panelID' => $panelID ),
    		array( 'ID' => $ID ), 
    		array( '%s' ), 
    		array( '%d' )
    	);
    } 

}

function panel_planner_menu(){
	add_options_page('Panel Planner Settings','Panel Planner Settings', 'manage_options','panelplanner-options.php','panel_planner_gen_options_page');
}

function panel_planner_activate(){

	error_log("Starting activation of the plugin");

	install_database();

	remove_role("panel_planner"); //This is here in case the following code changes. As otherwise it will not overwrite the old settings.
	/**
	add_role ("panel_planner", "Panel Planner", array( //I'd love to set this to user level 0, but that's depricated.
		'read' => false,
		'edit_posts' => false, 
		'delete_posts' => false,
		) 
	);

	// This is useful later. Not useful at this point.

	if( null !== $result ){
		echo "Panel Planner role created.";
	}else{
		echo "Panel Planner role already exists";
	}
	$custom_capability = 'Approve Panels';
	

	// Making the stage 1 page.

	$my_page = array(
	'post_title' => 'Propose a Panel',
	'post_content' => panel_planner_build_form('panelplanner-stage1.php'),
	'post_status' => 'publish',
	'post_type' => 'page',
	'post_author' => 2,
	'post_date' => '2012-08-20 15:10:30'
	);

	//$post_id = wp_insert_post($my_page);

	$my_page = array(
	'post_title' => 'Panel Proposal - Stage 2',
	'post_content' => panel_planner_build_form('panelplanner-stage2.php'),
	'post_status' => 'private',
	'post_type' => 'page',
	'post_author' => 2,
	'post_date' => '2012-08-20 15:10:30'
	);
	//$post_id = wp_insert_post($my_page);
**/
	
}

function panel_planner_deactivate(){

}

function panel_planner_uninstall(){
	remove_role("panel_planner"); //Remove old user rights.
}

/** Main method for running Panel Planner */
new panel_planner_stage_1;
new panel_planner_stage_2;
add_action( 'admin_menu', 'panel_planner_menu');
register_activation_hook( __FILE__, 'panel_planner_activate');
register_deactivation_hook(__FILE__, 'panel_planner_deactivate');
register_uninstall_hook(__FILE__, 'panel_planner_uninstall');
?>
