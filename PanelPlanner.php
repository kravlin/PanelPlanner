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

class panel_planner_stage_1{
	function __construct(){
		trigger_error('panel planner 1 running', E_USER_WARNING );
		add_shortcode('panel_planner_1', array($this, 'panel_planner_stage_1'));
	}
	
	public function panel_planner_stage_1(){
		ob_start();
		$this->panel_planner_stage_1_process();
		ob_get_clean();
	}

	static public function panel_planner_stage_1_form() {
		echo "herpdaderp";
    	//echo file_get_contents(dirname(__FILE__).'/pp_stage1.php');
	}

	public function panel_planner_stage_1_process(){

        self::panel_planner_stage_1_form();
	}


}

class panel_planner_stage_2{

	function __construct(){
		add_shortcode('panel_planner_2', array($this, 'panel_planner_stage_2'));
	}
	
	public function panel_planner_stage_2(){
		ob_start();
		$this->panel_planner_stage_2_process();
		ob_get_clean();
	}

	static public function panel_planner_stage_2_form() {
		echo "derpdaherp";
    	echo file_get_contents(dirname(__FILE__).'/pp_stage2.php');
	}
	
	public function panel_planner_stage_2_process(){
		
		self::panel_planner_stage_2_form();
	}
}

include dirname(__FILE__) .'/panelplanner-viewcampaign.php';
include dirname(__FILE__) .'/panelplanner-viewpanel.php';

function panel_planner_build_form($fname){
    $toReturn = file_get_contents(dirname(__FILE__).'/'.$fname);
    return $toReturn;
}

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

	// This is useful later. Not useful at this point.
	/**
	if( null !== $result ){
		echo "Panel Planner role created.";
	}else{
		echo "Panel Planner role already exists";
	}
	$custom_capability = 'Approve Panels';
	**/

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