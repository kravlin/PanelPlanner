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
		add_options_page('Panel Planner Settings','Panel Planner Settings', 'manage_options','panelplanner-options.php','panel_planner_gen_options');}

function panel_planner_admin(){
	if( !current_user_can( 'manage_options') ){
		wp_die( __( 'You do not have permission to access this page.') );
	}
	echo '<div class="wrap">';
	echo '<p>Options will eventually go here.</p>';
	echo '</div>';
}


/** Main method for instantiating Panel Planner */
add_action( 'admin_menu', 'panel_planner_menu');


?>