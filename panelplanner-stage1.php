<html>
<head><title> NDK Panel Form - Stage 1 </title>
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
</head>
<body>
<?php
function panel_planner_build_form_stage1(){
    //Begin Javascript

    //End Javascript

    echo '<form action="panelplanner-stage1.php" method="post">';

	//Begin Panelist
    echo '<p>';
	echo 'First Name (required) <br />';
    echo '<input type="text" name="pp-first-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name"] ) ? esc_attr( $_POST["pp-first-name"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Last Name (required) <br />';
    echo '<input type="text" name="pp-last-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name"] ) ? esc_attr( $_POST["pp-last-name"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Email Address (required) <br />';
    echo '<input type="email" name="pp-email" value="' . ( isset( $_POST["pp-email"] ) ? esc_attr( $_POST["pp-email"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Age (required) <br />';
    echo '<input type="text" name="pp-age" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age"] ) ? esc_attr( $_POST["pp-age"] ) : '' ) . '" size="40" />';
    echo '</p>';
    //End Panelist
    
    echo '<p>';
    echo '<input type="checkbox" checked="false" id="has_copanelist" onchange="javascript:show_hide(\'CoPanelist\',\'has_copanelist\');"/> I have a CoPanelist.';
    echo '</p>';

    //Begin Copanelist
    echo '<div id="CoPanelist" style="display: none" >'; 
    echo '<p>';
    echo 'First Name (required) <br />';
    echo '<input type="text" name="pp-first-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name2"] ) ? esc_attr( $_POST["pp-first-name2"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Last Name (required) <br />';
    echo '<input type="text" name="pp-last-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name2"] ) ? esc_attr( $_POST["pp-last-name2"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Email Address (required) <br />';
    echo '<input type="email" name="pp-email2" value="' . ( isset( $_POST["pp-email2"] ) ? esc_attr( $_POST["pp-email2"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Age (required) <br />';
    echo '<input type="text" name="pp-age2" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age2"] ) ? esc_attr( $_POST["pp-age2"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '</div>';
    //End Copanelist

    //Begin Panel
    echo '<p>';
    echo 'Panel Title (required) <br />';
    echo '<input type="text" name="pp-title" value="' . ( isset( $_POST["pp-title"] ) ? esc_attr( $_POST["pp-title"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo 'Short Panel Description (required) <br />';
    echo '<textarea rows="10" cols="35" name="pp-description">' . ( isset( $_POST["pp-description"] ) ? esc_attr( $_POST["pp-description"] ) : '' ) . '</textarea>';
    echo '</p>';
    echo '<p>';
    echo 'Detailed Panel outline (required) <br />';
    echo '<textarea rows="10" cols="35" name="pp-outline">' . ( isset( $_POST["pp-outline"] ) ? esc_attr( $_POST["pp-outline"] ) : '' ) . '</textarea>';
	echo '</p>';
    echo '<p><input type="submit" name="pp-submitted" value="Send"/></p>';
    echo '</form>';
    //End Panel
}

function save_input(){
	if ( isset( $_POST['pp-submitted'] ) ) {
		$first_name = sanitize_text_field( $_POST["pp-first-name"]);
		$last_name = sanitize_text_field( $_POST["pp-last-name"]);
		$email_address = sanitize_email( $_POST["pp-email"]);
		$age = sanitize_text_field( $_POST["pp-age"]);

		$first_name2 = sanitize_text_field( $_POST["pp-first-name2"]);
		$last_name2 = sanitize_text_field( $_POST["pp-last-name2"]);
		$email_address2 = sanitize_email( $_POST["pp-email2"]);
		$age2 = sanitize_text_field( $_POST["pp-age2"]);

		$panel_description = esc_textarea( $_POST["pp-description"]);
		$panel_outline = esc_textarea( $_POST["pp-outline"]);
	}
	$to = get_option( 'admin_email' );
}
function send_mail(){

}

panel_planner_build_form_stage1();

?>

</body>
</html>
