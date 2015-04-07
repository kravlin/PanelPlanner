<?php
	class panel_planner_stage_1{

		private $form_errors = array();
	
		function __construct(){
			add_shortcode('panel_planner_1', array($this, 'panel_planner_stage_1'));
		}
		
		public function panel_planner_stage_1(){
			$this->panel_planner_stage_1_process();
		}
	
		//This is a really terrible method. No likey.
		//Too long, too much that's just...defined.
		static public function panel_planner_stage_1_form() {
			echo '<script type="text/Javascript">
    		function show_hide(element1, element2) {
    		    if (document.getElementById(element2).checked){
    		        document.getElementById(element1).style.display = "";
    		    }
    		    else{
    		        document.getElementById(element1).style.display = "none";
    		    }
    		}';
			echo '</script>';
			echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
			echo '<!-- Begin Panelist -->';
			echo '<p>';
			echo 'First Name (required) <br />';
			echo '<input type="text" name="pp-first-name" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Last Name (required) <br />';
			echo '<input type="text" name="pp-last-name" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Email Address (required) <br />';
			echo '<input type="email" name="pp-email" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Age (required) <br />';
			echo '<input type="text" name="pp-age" pattern="[0-9]+" size="40" />';
			echo '</p>';
			echo '<!-- End Panelist -->';
			echo '<p>';
//			echo '<input type="checkbox" checked="false" id="pp-hasCopanelist" onchange="javascript:show_hide("pp-hasCopanelist");"/> I have a CoPanelist.';
//			echo '</p>';
//			echo '<!-- Begin Copanelist -->';
//			echo '<div id="CoPanelist" style="display: none" >';
			echo '<p>';
			echo 'First Name (required) <br />';
			echo '<input type="text" name="pp-first-name2" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Last Name (required) <br />';
			echo '<input type="text" name="pp-last-name2" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Email Address (required) <br />';
			echo '<input type="email" name="pp-email2"  size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Age (required) <br />';
			echo '<input type="text" name="pp-age2" pattern="[0-9]+" size="40" />';
			echo '</p>';
//			echo '</div>';
			echo '<!-- End Copanelist / Begin Panel -->';
			echo '<p>';
			echo 'Panel Title (required) <br />';
			echo '<input type="text" name="pp-title" size="40" />';
			echo '</p>';
			echo 'Short Panel Description (required) <br />';
			echo '<textarea rows="10" cols="35" name="pp-description">Please place a short description of your panel here. Similar to one you\'d see in the program.</textarea>';
			echo '</p>';
			echo '<p>';
			echo 'Detailed Panel outline (required) <br />';
			echo '<textarea rows="10" cols="35" name="pp-outline">Outline your panel here, what are you going to talk about? how long do you expect the different parts to last?</textarea>';	
			echo '</p>';
			echo '<p><input type="submit" name="pp-submitted" value="Send"/></p>';
			echo '</form>';
		}
	
		public function panel_planner_stage_1_process(){
			error_log("Plugin be runnin");
			if ( isset($_POST['pp-submitted']) ) {
				$this->panel_planner_stage_1_validate_form(
					$_POST['pp-first-name'], $_POST['pp-last-name'],
					$_POST['pp-email'], $_POST['pp-age'],
					$_POST['pp-first-name2'], $_POST['pp-last-name2'],
					$_POST['pp-email2'], $_POST['pp-age2'],
					$_POST['pp-title'], $_POST['pp-description'],
					$_POST['pp-outline']);
				if(is_array($this->form_errors)) {
					foreach($this->form_errors as $error) {
						echo '<div>';
						echo '<strong>ERROR</strong>';
						echo ' '. $error . '<br/>';
						echo '</div>';
					}
				}
		 	}
			$this->panelplanner_panel_1_save_input($_POST['pp-first-name'], $_POST['pp-last-name'],
					$_POST['pp-email'], $_POST['pp-age'],
					$_POST['pp-first-name2'], $_POST['pp-last-name2'],
					$_POST['pp-email2'], $_POST['pp-age2'],
					$_POST['pp-title'], $_POST['pp-description'],
					$_POST['pp-outline']);
    		self::panel_planner_stage_1_form();
		}
	
		// This method is going to get really ugly REALLY fast.
		// Upgrade Plans? Make seperate auth messages. But that comes with custom campaigns.
	
		private function panel_planner_stage_1_validate_form($fname, $lname, $email, $age, $fname2, $lname2, $email2, $age2, $title, $desc, $outline){
		    if ( empty($fname) ){
    		   	array_push( $this->form_errors, 'First name cannot be left empty' );
		    }
		    if ( empty($flname) ){
				array_push( $this->form_errors, 'Last name cannot be left empty' );
			}
			if ( empty($email) ){
				array_push( $this->form_errors, 'Email cannot be left empty' );
			} 
			if ( empty($age) ){
    			array_push( $this->form_errors, 'Age cannot be left empty' );
			}
			if ( empty($title) ){
    	     	array_push( $this->form_errors, 'Panel title cannot be left empty' );
			}
			if ( empty($desc) ){
    	    	array_push( $this->form_errors, 'Panel description cannot be left empty' );
			}
			if ( empty($outline) ){
    	     	array_push( $this->form_errors, 'Panel outline cannot be left empty' );
    	 	}
    	 	if ( !is_email($email) ) {
    	     	array_push( $this->form_errors, 'Panelist email is not valid' );
    	    }
    	    if ( !is_email($email2) ) {
    	     	array_push( $this->form_errors, 'Copanelist email is not valid' );
    	    }
    	}

    	private function panelplanner_insert_panelist($fname,$lname,$email,$age){
    		global $wpdb;
    		$tableName = $wpdb->prefix . "panelPlanner_panelists";

    		$wpdb->query($wpdb->replace(
    			$tableName,
    			array(
    				'firstName' => $fname,
    				'lastName' => $lname,
    				'email' => $email,
    				'age' => $age
    			),
    			array(
    				'%s',
    				'%s',
    				'%s',
    				'%d'
    			)
    		) );
    		return $wpdb->insert_id;
    	}

    	private function panelplanner_insert_panel($panelistID,$copanelistID,$title,$desc,$outline){
    		global $wpdb;
    		$tableName = $wpdb->prefix . "panelPlanner_panels";

    		$wpdb->insert(
    			$tableName,
    			array(
    				'panelistID' => $panelistID,
    				'copanelistID' => $copanelistID,
    				'title' => $title,
    				'description' => $desc,
    				'outline' => $outline
    			),
    			array(
    				'%d',
    				'%d',
    				'%s',
    				'%s',
    				'%s'
    			)
    		);
    		return $wpdb->insert_id;
    	}

		private function panelplanner_panel_1_save_input($fname, $lname, $email, $age, $fname2, $lname2, $email2, $age2, $title, $desc, $outline){
			global $wpdb;

			$table_name = $wpdb->prefix . "panelplanner_panelists";

			$panelistID = $this->panelplanner_insert_panelist($fname, $lname, $email, $age);
			$copanelistID = $this->panelplanner_insert_panelist($fname2, $lname2, $email2, $age2);

			$table_name = $wpdb->prefix . "panelplanner_panels";

			$panelID = $this->panelplanner_insert_panel($panelistID, $copanelistID, $title, $desc, $outline);
		}


	}
?>