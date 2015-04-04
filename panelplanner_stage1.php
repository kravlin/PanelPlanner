<?php
class panel_planner_stage_1{
	function __construct(){
		add_shortcode('panel_planner_1', array($this, 'panel_planner_stage_1'));
	}
	
	public function panel_planner_stage_1(){
		$this->panel_planner_stage_1_process();
	}

	static public function panel_planner_stage_1_form() {
    echo	<<<EOT
<script type="text/Javascript">
    function show_hide(element1, element2) {
        if (document.getElementById(element2).checked){
            document.getElementById(element1).style.display = "";
        }
        else{
            document.getElementById(element1).style.display = "none";
        }
    }
</script>

<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

<!-- Begin Panelist -->

<p>
First Name (required) <br />
<input type="text" name="pp-first-name" pattern="[a-zA-Z0-9 ]+" size="40" />
</p>
<p>
Last Name (required) <br />
<input type="text" name="pp-last-name" pattern="[a-zA-Z0-9 ]+" size="40" />
</p>
<p>
Email Address (required) <br />
<input type="email" name="pp-email" size="40" />
</p>
<p>
Age (required) <br />
<input type="text" name="pp-age" pattern="[0-9]+" size="40" />
</p>

<!-- End Panelist -->

<p>
<input type="checkbox" checked="false" id="pp-hasCopanelist" onchange="javascript:show_hide('pp-hasCopanelist');"/> I have a CoPanelist.
</p>

<!-- Begin Copanelist -->

<div id="CoPanelist" style="display: none" >
<p>
First Name (required) <br />
<input type="text" name="pp-first-name2" pattern="[a-zA-Z0-9 ]+" size="40" />
</p>
<p>
Last Name (required) <br />
<input type="text" name="pp-last-name2" pattern="[a-zA-Z0-9 ]+" size="40" />
</p>
<p>
Email Address (required) <br />
<input type="email" name="pp-email2"  size="40" />
</p>
<p>
Age (required) <br />
<input type="text" name="pp-age2" pattern="[0-9]+" size="40" />
</p>
</div>

<!-- End Copanelist / Begin Panel -->

<p>
Panel Title (required) <br />
<input type="text" name="pp-title" size="40" />
</p>
Short Panel Description (required) <br />
<textarea rows="10" cols="35" name="pp-description">Please place a short description of your panel here. Similar to one you'd see in the program.</textarea>
</p>
<p>
Detailed Panel outline (required) <br />
<textarea rows="10" cols="35" name="pp-outline">Outline your panel here, what are you going to talk about? how long do you expect the different parts to last?</textarea>
</p>
<p><input type="submit" name="pp-submitted" value="Send"/></p>
</form>
EOT;
	}

	public function panel_planner_stage_1_process(){
		if ( isset($_POST['pp-submitted']) ) {
			$this->pp_panel_1_validate_form(
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
					echo $error . '<br/>';
					echo '</div>';
				}
			}
	 	}
		$this->pp_panel_1_save_input($_POST['pp-first-name'], $_POST['pp-last-name'],
				$_POST['pp-email'], $_POST['pp-age'],
				$_POST['pp-first-name2'], $_POST['pp-last-name2'],
				$_POST['pp-email2'], $_POST['pp-age2'],
				$_POST['pp-title'], $_POST['pp-description'],
				$_POST['pp-outline']);
    	self::panel_planner_stage_1_form();
	}
	private function pp_panel_1_validate_form(){
		
	}
	private function pp_panel_1_save_input(){

	}

}
?>