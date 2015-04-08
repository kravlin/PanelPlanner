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
			echo '<input type="text" name="pp-first-name" value="'. ( isset( $_POST["pp-first-name"] ) ? esc_attr( $_POST["pp-first-name"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Last Name (required) <br />';
			echo '<input type="text" name="pp-last-name" value="'. ( isset( $_POST["pp-last-name"] ) ? esc_attr( $_POST["pp-last-name"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Email Address (required) <br />';
			echo '<input type="email" name="pp-email" value="'. ( isset( $_POST["pp-email"] ) ? esc_attr( $_POST["pp-email"] ) : '' ) .'" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Age (required) <br />';
			echo '<input type="text" name="pp-age" value="'. ( isset( $_POST["pp-age"] ) ? esc_attr( $_POST["pp-age"] ) : '' ) .'" pattern="[0-9]+" size="40" />';
			echo '</p>';
			echo '<!-- End Panelist -->';
			echo '<p>';
			echo '<input type="checkbox" id="pp-hasCopanelist" onchange="javascript:show_hide("CoPanelist","pp-hasCopanelist");"/> I have a CoPanelist.';
			echo '</p>';
			echo '<!-- Begin Copanelist -->';
			echo '<div id="CoPanelist" style="display: none" >';
			echo '<p>';
			echo 'First Name (required) <br />';
			echo '<input type="text" name="pp-first-name2" value="'. ( isset( $_POST["pp-first-name2"] ) ? esc_attr( $_POST["pp-first-name2"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Last Name (required) <br />';
			echo '<input type="text" name="pp-last-name2" value="'. ( isset( $_POST["pp-last-name2"] ) ? esc_attr( $_POST["pp-last-name2"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Email Address (required) <br />';
			echo '<input type="email" name="pp-email2" value="'. ( isset( $_POST["pp-email2"] ) ? esc_attr( $_POST["pp-email2"] ) : '' ) .'" size="40" />';
			echo '</p>';
			echo '<p>';
			echo 'Age (required) <br />';
			echo '<input type="text" name="pp-age2" value="'. ( isset( $_POST["pp-age2"] ) ? esc_attr( $_POST["pp-age2"] ) : '' ) .'" pattern="[0-9]+" size="40" />';
			echo '</p>';
			echo '</div>';
			echo '<!-- End Copanelist / Begin Panel -->';
			echo '<p>';
			echo 'Panel Title (required) <br />';
			echo '<input type="text" name="pp-title" value="'. ( isset( $_POST["pp-title"] ) ? esc_attr( $_POST["pp-title"] ) : '' ) .'" size="40" />';
			echo '</p>';
			echo 'Short Panel Description (required) <br />';
			echo '<textarea rows="10" cols="35" name="pp-description" >'. ( isset( $_POST["pp-description"] ) ? esc_attr( $_POST["pp-description"] ) : 'Please place a short description of your panel here. Similar to one you would see in the program.' ) .'</textarea>';
			echo '</p>';
			echo '<p>';
			echo 'Detailed Panel outline (required) <br />';
			echo '<textarea rows="10" cols="35" name="pp-outline">'. ( isset( $_POST["pp-outline"] ) ? esc_attr( $_POST["pp-outline"] ) : 'Outline your panel here, what are you going to talk about? How long do you expect the different parts to last?' ) .'</textarea>';	
			echo '</p>';
			echo '<p><input type="submit" name="pp-submitted" value="Send"/></p>';
			echo '</form>';
		}
	
		public function panel_planner_stage_1_process(){
			if ( isset($_POST['pp-submitted']) ) {
				error_log("Panel Submission Started");
				$this->panelplanner_stage_1_validate_form(
					$_POST['pp-first-name'], $_POST['pp-last-name'],
					$_POST['pp-email'], $_POST['pp-age'],
					$_POST['pp-first-name2'], $_POST['pp-last-name2'],
					$_POST['pp-email2'], $_POST['pp-age2'],
					$_POST['pp-title'], $_POST['pp-description'],
					$_POST['pp-outline']);
				error_log("Number of errors: ".count($this->form_errors));
				if( count($this->form_errors) != 0 ) {
					foreach($this->form_errors as $error) {
						error_log("Errors found in panel submission.");
						echo '<div>';
						echo '<strong>ERROR</strong>';
						echo ' '. $error . '<br/>';
						echo '</div>';
					}
					self::panel_planner_stage_1_form();
				}
				elseif ( count($this->form_errors) == 0 ){
					error_log("No Errors detected in form. Saving input");
					$panelID = $this->panelplanner_panel_1_save_input(
						$_POST['pp-first-name'], $_POST['pp-last-name'],
						$_POST['pp-email'], $_POST['pp-age'],
						$_POST['pp-first-name2'], $_POST['pp-last-name2'],
						$_POST['pp-email2'], $_POST['pp-age2'],
						$_POST['pp-title'], $_POST['pp-description'],
						$_POST['pp-outline']);
					$this->panelplanner_panel_1_email(
						$_POST['pp-first-name'], $_POST['pp-last-name'],
						$_POST['pp-email'], $_POST['pp-age'],
						$panelID, $_POST['pp-title'], $_POST['pp-description'],
						$_POST['pp-outline']);
				}
				error_log("Reading Input Correct");

		 	}
			else{
				self::panel_planner_stage_1_form();
			}
    					

		}
	
		// This method is going to get really ugly REALLY fast.
		// Upgrade Plans? Make seperate auth messages. But that comes with custom campaigns.
	
		private function panelplanner_stage_1_validate_form($fname, $lname, $email, $age, $fname2, $lname2, $email2, $age2, $title, $desc, $outline){
		    if ( empty($fname) ){
    		   	array_push( $this->form_errors, 'First name cannot be left empty' );
		    }
		    if ( empty($lname) ){
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
    	    if($fname2 != NULL){
    	    	if ( empty($fname2) ){
    		   		array_push( $this->form_errors, 'Copanelist first name cannot be left empty' );
		    	}
		    	if ( empty($lname2) ){
					array_push( $this->form_errors, 'Copanelist last name cannot be left empty' );
				}
    	    	if ( !is_email($email2) ) {
    	     		array_push( $this->form_errors, 'Copanelist email is not valid' );
    	    	}
    	    	if ( empty($age2) ){
    				array_push( $this->form_errors, 'Copanelist age cannot be left empty' );
    			}

    	    }

    	}

    	private function panelplanner_insert_panelist($fname,$lname,$email,$age){
    		global $wpdb;
    		$tableName = $wpdb->prefix . "panelPlanner_panelists";
    		$id = $wpdb->get_var( $wpdb->prepare(
    			"SELECT id FROM ".$tableName."
    			WHERE firstName = %s AND
    			lastName = %s AND
    			email = %s
    			",
    			$fname,
    			$lname,
    			$email
    		) );

    		if($id == NULL){
    			$wpdb->insert(
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
    			);
    			$id = $wpdb->insert_id;
    		}
    		return $id;
    	}

    	private function panelplanner_insert_panel($panelistID,$copanelistID,$title,$desc,$outline){
    		global $wpdb;
    		$tableName = $wpdb->prefix . "panelPlanner_panels";
    		if($copanelistID != 0){
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
    		}else{
    			$wpdb->insert(
    				$tableName,
    				array(
    					'panelistID' => $panelistID,
    					'title' => $title,
    					'description' => $desc,
    					'outline' => $outline
    				),
    				array(
    					'%d',
    					'%s',
    					'%s',
    					'%s'
    				)
    			);    		    			
    		}
    		return $wpdb->insert_id;
    	}

		private function panelplanner_panel_1_save_input($fname, $lname, $email, $age, $fname2, $lname2, $email2, $age2, $title, $desc, $outline){
			global $wpdb;

			$table_name = $wpdb->prefix . "panelplanner_panelists";
			error_log("Saving Panelist");
			$panelistID = $this->panelplanner_insert_panelist($fname, $lname, $email, $age);
			if( $_POST['pp-hasCopanelist'] ){
				error_log("Saving Copanelist");
				$copanelistID = $this->panelplanner_insert_panelist($fname2, $lname2, $email2, $age2);
			}else{
				error_log("No CoPanelist");
			}
			$table_name = $wpdb->prefix . "panelplanner_panels";
			error_log("Saving Panel");
			$panelID = $this->panelplanner_insert_panel($panelistID, $copanelistID, $title, $desc, $outline);
			return $panelID;
		}

		private function panelplanner_panel_1_email($fname, $lname, $email, $age, $panelID, $title, $description, $outline){
				$subject = "panel submission #".$panelID." has come in!";
				$headers = "From: Panel Submission <donotrespond@ndkdenver.org>";
				$message = "A new panel submission has come in. Details below \n\n".
				"Submitted by: ".$fname." ".$lname."\n".
				"Contact Email".$email."\n".
				"Age".$age."\n".
				"Title: ".$title."\n".
				"Description: ".$description."\n".
				"Outline: ".$outline; 
				if( wp_mail($email, $subject, $message, $headers)){
					$subject = "Your panel submission #".$panelID."  has been recieved ";
					$headers = "From: Panel Submission <donotrespond@ndkdenver.org>";
					$message = "Dear ".$fname." ".$lname.",\n\n".
					"Thank you for submitting your panel for NDK2015.\n\n".
					"Title: $title\n".
					"Your panel submission number is: ".$panelID."\n\n".
					"Panel submissions end on June 28th at 6:00pm.\n If you'd like to submit more panel ideas, please do so before the deadline.\n".
					"We should get back to you shortly after the submission deadline ends.\n".
					"If you have any questions or suggestions on the submission process, please contact josh.sorenson@ndkdenver.org\n\n".
					"Thanks,\n".
					"NDK Panel Department Staff";
					if( wp_mail($email, $subject, $message, $headers)){
						echo 'Thank you for submitting your panel idea.<br>';
						echo "Your submission is number #".$panelID."<br>";
						echo "A confirmation email has been sent to your email account.";
						echo "Please email josh.sorenson@ndkdenver.org if you have any questions";
					}
					else{
						echo "Sorry, something went wrong with your panel submission.<br>";
						echo "Please contact josh.sorenson@ndkdenver.org and reference the below panel application number."."<br>";
						echo "PanelID: ".$panelID."<br><br>";
						echo "Sorry about that :(";
					}
				}
		}


	}
?>