defined('ABSPATH') or die("No script kiddies please!");

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
/**
if(!class_exists('PanelPlanner'))
{
	class PanelPlanner
	{

	/**Construct the plugin**/
		public function __construct(){
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
		}
	/**Activate the plugin**/
		public static function activate(){
			
		}
	/**Deactivate the plugin**/
		public static function deactivate(){

		}
	/**Hook into WP's admin_init action hook**/
		public function admin_init(){
			$this->init_settings()
		}
		public function init_settings(){
			/**FIX THE BELOW**/
    		register_setting('PanelPlanner-group', 'setting_a');
   			register_setting('PanelPlanner-group', 'setting_b');
		}
		public function add_menu()
			    add_options_page('PanelPlanner Settings', 'PanelPlanner', 'manage_options',
			    'PannelPlanner', array(&$this, 'plugin_settings_page'));
	}
}
if(class_exists('PanelPlanner'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('PanelPlanner', 'activate'));
    register_deactivation_hook(__FILE__, array('PanelPlanner', 'deactivate'));

    // instantiate the plugin class
    $PanelPlanner = new PanelPlanner();
    // Add a link to the settings page onto the plugin page
	if(isset($PanelPlanner))
	{
    	// Add the settings link to the plugins page
    	function plugin_settings_link($links)
    	{ 
    	    $settings_link = '<a href="options-general.php?page=PannelPlanner">Settings</a>'; 
    	    array_unshift($links, $settings_link); 
    	    return $links; 
    	}
    	$plugin = plugin_basename(__FILE__); 
   		add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
	}
}
**/

function panel_planner_menu(){
		add_options_page( 'Panel Planner Options', 'Panel Planner', 'manage_options','panel_planner','panel_planner_admin' );
}

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