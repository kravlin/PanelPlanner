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


function panel_planner_menu(){
	add_options_page('Panel Planner Settings','Panel Planner Settings', 'manage_options','panelplanner-options.php','panel_planner_gen_options_page');
}

function panel_planner_activate(){
	remove_role("panel_planner"); //This is here in case the following code changes. As otherwise it will not overwrite the old settings.
	add_role ("panel_planner", "Panel Planner", array( //I'd love to set this to user level 0, but that's depricated.
		'read' => false,
		'edit_posts' => false, 
		'delete_posts' => false,
		) 
	);
	if( null !== $result ){
		echo "Panel Planner role created.";
	}else{
		echo "Panel Planner role already exists";
	}
}

function panel_planner_deactivate(){

}

function panel_planner_uninstall(){
	remove_role("panel_planner"); //Remove old user rights.
}

/** Main method for running Panel Planner */
add_action( 'admin_menu', 'panel_planner_menu');
register_activation_hook( __FILE__, 'panel_planner_activate');
register_deactivation_hook(__FILE__, 'panel_planner_deactivate');
register_uninstall_hook(__FILE__, 'panel_planner_uninstall');

?>