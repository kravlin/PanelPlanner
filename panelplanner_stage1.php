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
    		        document.getElementById(element1).style.display = "none";
    		    }
    		    else{
    		        document.getElementById(element1).style.display = "";
    		    }

    		}';
			echo '</script>';
			echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
			echo '<!-- Begin Panelist -->';
			echo '<div class="form-group">';
			echo '<label for="pp-first-name">First Name (required) </label>';
			echo '<input type="text" name="pp-first-name" value="'. ( isset( $_POST["pp-first-name"] ) ? esc_attr( $_POST["pp-first-name"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-last-name">Last Name (required) </label>';
			echo '<input type="text" name="pp-last-name" value="'. ( isset( $_POST["pp-last-name"] ) ? esc_attr( $_POST["pp-last-name"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-email">Email Address (required) </label>';
			echo '<input type="email" name="pp-email" value="'. ( isset( $_POST["pp-email"] ) ? esc_attr( $_POST["pp-email"] ) : '' ) .'" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-age">Age (required) </label>';
			echo '<input type="text" name="pp-age" value="'. ( isset( $_POST["pp-age"] ) ? esc_attr( $_POST["pp-age"] ) : '' ) .'" pattern="[0-9]+" size="40" />';
			echo '</div>';
			
			echo '<!-- End Panelist -->';
			echo '<div class="form-group">';
			echo '<input onchange="javascript:show_hide(\'pp-CoPanelist\',\'pp-hasCopanelist\');" type="checkbox" id="pp-hasCopanelist" autocomplete="off" /> I don\'t have a CoPanelist.';
			echo '</div>';
			echo '<!-- Begin Copanelist -->';
			echo '<div id="pp-CoPanelist" class="form-group">';
			echo '<label for="pp-first-name2">Copanelist First Name (required) </label>';
			echo '<input type="text" name="pp-first-name2" value="'. ( isset( $_POST["pp-first-name2"] ) ? esc_attr( $_POST["pp-first-name2"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-last-name2">Copanelist Last Name (required) </label>';
			echo '<input type="text" name="pp-last-name2" value="'. ( isset( $_POST["pp-last-name2"] ) ? esc_attr( $_POST["pp-last-name2"] ) : '' ) .'" pattern="[a-zA-Z0-9 ]+" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-email2">Copanelist Email Address (required) </label>';
			echo '<input type="email" name="pp-email2" value="'. ( isset( $_POST["pp-email2"] ) ? esc_attr( $_POST["pp-email2"] ) : '' ) .'" size="40" />';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-age2">Copanelist Age (required) </label>';
			echo '<input type="text" name="pp-age2" value="'. ( isset( $_POST["pp-age2"] ) ? esc_attr( $_POST["pp-age2"] ) : '' ) .'" pattern="[0-9]+" size="40" />';
			echo '</div>';
			echo '<!-- End Copanelist / Begin Panel -->';
			echo '<div class="form-group">';
			echo '<label for="pp-title">Panel Title (required) </label>';
			echo '<input type="text" name="pp-title" value="'. ( isset( $_POST["pp-title"] ) ? esc_attr( $_POST["pp-title"] ) : '' ) .'" size="40" />';
			echo '<textarea rows="10" cols="35" name="pp-description" >'. ( isset( $_POST["pp-description"] ) ? esc_attr( $_POST["pp-description"] ) : 'Please place a short description of your panel here. Similar to one you would see in the program.' ) .'</textarea>';
			echo '</div>';
			echo '<div class="form-group">';
			echo '<label for="pp-outline">Detailed Panel outline (required) </label>';
			echo '<textarea rows="10" cols="35" name="pp-outline">'. ( isset( $_POST["pp-outline"] ) ? esc_attr( $_POST["pp-outline"] ) : 'Outline your panel here, what are you going to talk about? How long do you expect the different parts to last?' ) .'</textarea>';	
			echo '</div>';
			echo '<input type="submit" name="pp-submitted" value="Send"/>';
			echo '</form>';
		}
		static public function panel_planner_disclaimer() {
			echo 'Thank you for your interest in running a panel (or other activity) at Nan Desu Kan 2015. We look forward to reading your proposal.<br>';
			echo '<br>';
			echo 'If you haven\'t yet done so, please take this time to go read the <a href="/ndk-events/panels/guidelines">Panel Guidelines</a>.<br><br>';
			echo 'All prospective panelists <strong>must</strong> read and understand these guidelines before they submit proposals. Failure to understand the guidelines could result in the rejection of your proposal.<br>';
			echo '<br>';
			echo 'If you aren\'t prepared to submit a detailed proposal just yet, please take your time to flesh out your panel idea. We\'d rather see a strong proposal later on than a weak one earlier on.<br>';
			echo '<br>';
			echo 'Please don\'t delay too long, however. The deadline to submit the detailed proposal for your panel is <strong>, June 28 </strong>at 10:00 PM MST. This form will be disabled after that time and all panels not submitted by that point will be rejected <strong>without exception</strong>. You must also be pre-registered for NDK (or be on NDK Staff) before submitting this form. If you haven\'t pre-registered, please <a href="/registration">do so now</a>. We\'ll be checking submissions against our pre-registration records.<br>';
			echo '<br>';
			echo 'If you\'ve read the <a href="/ndk-events/panels/guidelines">Panel Guidelines</a>, fleshed out your panel idea, and are ready to submit a detailed proposal, please continue.<br><br>';
			echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
			echo '<p><input type="submit" name="pp-guidelines-accept" value="Accept"/></p>';
			echo '</form>';
		}
		public function panel_planner_stage_1_process(){
			if ( isset($_POST['pp-guidelines-accept']) ) {
				self::panel_planner_stage_1_form();
			} 
			elseif ( isset($_POST['pp-submitted']) ) {
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
						$_POST['pp-outline'],'josh.sorenson@ndkdenver.org');
				}
				error_log("Reading Input Correct");

		 	}
			else{
				self::panel_planner_disclaimer();
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
			$copanelistID = 0;
			if( isset($_POST['pp-hasCopanelist']) ){
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

		private function panelplanner_panel_1_email($fname, $lname, $email, $age, $panelID, $title, $description, $outline, $staffEmail){
				$subject = "panel submission #".$panelID." has come in!";
				$headers = "From: Panel Submission <donotreply@ndkdenver.org>";
				$message = "A new panel submission has come in. Details below \n\n".
				"Submitted by: ".$fname." ".$lname."\n".
				"Contact Email: ".$email."\n".
				"Age: ".$age."\n".
				"Title: ".$title."\n".
				"Description: ".$description."\n".
				"Outline: ".$outline; 
				if( wp_mail($staffEmail, $subject, $message, $headers)){
					$subject = "Your panel submission #".$panelID."  has been recieved ";
					$headers = "From: Panel Submission <donotreplyndkdenver.org>";
					$message = "Dear ".$fname." ".$lname.",\n\n".
					"Thank you for submitting your panel idea.\n".
					"Panels Staff has received your proposal and will review it before giving you an answer on whether it's been accepted.\n".
					"They may have some final questions about or suggestions for your panel, so be prepared to respond to any messages.\n".
					"Please note that your panel hasn not yet been accepted. Panels will only be accepted after we've had a chance to review all submitted panels.\n\n".
					"Thank you for your patience, and thank you for your interest in running a panel at NDK2015\n".
					"NDK Panel Staff";
					if( wp_mail($email, $subject, $message, $headers)){
						echo 'Thank you for submitting your panel idea.<br>';
						echo "Your submission is number # ".$panelID."<br>";
						echo "A confirmation email has been sent to your email account.";
						echo "Please email josh.sorenson@ndkdenver.org if you have any questions";
					}
					else{
						echo "Sorry, something went wrong with your panel submission.<br>";
						echo "Please contact josh.sorenson@ndkdenver.org and reference the below panel application number.<br>";
						echo "PanelID: ".$panelID."<br><br>";
						echo "Sorry about that :(";
					}
				}
		}


	}
?>
