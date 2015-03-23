<?php

function panelplanner_build_form_stage2(){
    //Begin Javascript
    $toReturn = "";

    $toReturn .= '<script type="text/Javascript">';
    $toReturn .= 'function show_hide(element1, element2) {';
    $toReturn .= '    if (document.getElementById(element2).checked){';
    $toReturn .= '        document.getElementById(element1).style.display = "";';       
    $toReturn .= '   }';
    $toReturn .= '    else{';
    $toReturn .= '        document.getElementById(element1).style.display = "none";';
    $toReturn .= '    }';
    $toReturn .= '}';
    $toReturn .= '</script>';
    
    //End Javascript
    
    $toReturn .='<?php get_header(); ?>';
    $toReturn .='<div id="primary" class="site-content">';
    $toReturn .='<div id="content" role="main">';
    $toReturn .='<?php while ( have_posts() ) : the_post(); ?>';
    $toReturn .='<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>';
    $toReturn .='<header class="entry-header">';
    $toReturn .='<h1 class="entry-title"><?php the_title(); ?></h1>';
    $toReturn .='</header>';
    $toReturn .='<div class="entry-content">';
    $toReturn .='<?php the_content(); ?>';

    $toReturn .= '<form action="panelplanner-stage1.php" method="post">';

    //Begin Panelist
    $toReturn .= '<p>';
    $toReturn .= 'First Name (required) <br />';
    $toReturn .= '<input type="text" name="pp-first-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name"] ) ? esc_attr( $_POST["pp-first-name"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Last Name (required) <br />';
    $toReturn .= '<input type="text" name="pp-last-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name"] ) ? esc_attr( $_POST["pp-last-name"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Email Address (required) <br />';
    $toReturn .= '<input type="email" name="pp-email" value="' . ( isset( $_POST["pp-email"] ) ? esc_attr( $_POST["pp-email"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Age (required) <br />';
    $toReturn .= '<input type="text" name="pp-age" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age"] ) ? esc_attr( $_POST["pp-age"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    //End Panelist
    
    $toReturn .= '<p>';
    $toReturn .= '<input type="checkbox" checked="false" id="pp-hasCopanelist" onchange="javascript:show_hide(\'CoPanelist\',\'pp-hasCopanelist\');"/> I have a CoPanelist.';
    $toReturn .= '</p>';

    //Begin Copanelist
    $toReturn .= '<div id="CoPanelist" style="display: none" >'; 
    $toReturn .= '<p>';
    $toReturn .= 'First Name (required) <br />';
    $toReturn .= '<input type="text" name="pp-first-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name2"] ) ? esc_attr( $_POST["pp-first-name2"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Last Name (required) <br />';
    $toReturn .= '<input type="text" name="pp-last-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name2"] ) ? esc_attr( $_POST["pp-last-name2"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Email Address (required) <br />';
    $toReturn .= '<input type="email" name="pp-email2" value="' . ( isset( $_POST["pp-email2"] ) ? esc_attr( $_POST["pp-email2"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Age (required) <br />';
    $toReturn .= '<input type="text" name="pp-age2" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age2"] ) ? esc_attr( $_POST["pp-age2"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= '</div>';
    //End Copanelist

    //Begin Panel
    $toReturn .= '<p>';
    $toReturn .= 'Panel Title (required) <br />';
    $toReturn .= '<input type="text" name="pp-title" value="' . ( isset( $_POST["pp-title"] ) ? esc_attr( $_POST["pp-title"] ) : '' ) . '" size="40" />';
    $toReturn .= '</p>';
    $toReturn .= 'Short Panel Description (required) <br />';
    $toReturn .= '<textarea rows="10" cols="35" name="pp-description">' . ( isset( $_POST["pp-description"] ) ? esc_attr( $_POST["pp-description"] ) : '' ) . '</textarea>';
    $toReturn .= '</p>';
    $toReturn .= '<p>';
    $toReturn .= 'Detailed Panel outline (required) <br />';
    $toReturn .= '<textarea rows="10" cols="35" name="pp-outline">' . ( isset( $_POST["pp-outline"] ) ? esc_attr( $_POST["pp-outline"] ) : '' ) . '</textarea>';
    $toReturn .= '</p>';
    $toReturn .= '<p><input type="submit" name="pp-submitted" value="Send"/></p>';
    $toReturn .= '</form>';

    $toReturn .='</div><!-- .entry-content -->';
    $toReturn .='</article><!-- #post -->';
    $toReturn .='<?php endwhile; // end of the loop. ?>';
    $toReturn .='</div><!-- #content -->';
    $toReturn .='</div><!-- #primary -->';
    $toReturn .='<?php get_sidebar(); ?>';
    $toReturn .='<?php get_footer(); ?>';
    //End Panel
    
    return $toReturn;
}

function panel_planner_save_input_stage2(){

    try{
        $db_conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    //Prepare statements for insertion of panelists and panels
    
    $panelist_query = $db_conn->prepare("INSERT INTO panelists (firstName, lastName, emailAddress, age) VALUES (:firstname, :lastname, :email, :age)");
    $panelist_query->bindParam(':firstname', $firstName);
    $panelist_query->bindParam(':lastname', $lastName);
    $panelist_query->bindParam(':email', $email);
    $panelist_query->bindParam(':age', $age);

    $panel_query = $db_conn->prepare("INSERT INTO panel (panelTitle, panelDesc, panelOutline) VALUES (:paneltitle, :paneldescription, :paneloutline)");
    $panel_query->bindParam(':paneltitle', $panelTitle);
    $panel_query->bindParam(':paneldescription', $panelDescription);
    $panel_query->bindParam(':paneloutline', $panelOutline);

    //Insert new copanelist

    $firstName = sanitize_text_field( $_POST["pp-first-name"]);
    $lastName = sanitize_text_field( $_POST["pp-last-name"]);
    $panelist_email = sanitize_email( $_POST["pp-email"]);
    $email = $panelist_email;
    $age = sanitize_text_field( $_POST["pp-age"]);

    $panelistSuccess = $panelist_query->execute();
    $copanelist_success = true;
    $panelistID = $db_conn->lastInsertID();
    $copanelistID = 0;

    //What if they have a copanelist
    
    if(isset( $_POST['pp-hasCopanelist'] ) ){
        $firstName = sanitize_text_field( $_POST["pp-first-name2"]);
        $lastName = sanitize_text_field( $_POST["pp-last-name2"]);
        $email = sanitize_email( $_POST["pp-email2"]);
        $age = sanitize_text_field( $_POST["pp-age2"]);

        $copanelist_success = $panelist_query->execute();
        $copanelistID = $db_conn->lastInsertID();
    }

    //Store the panel information

    $panelTitle = sanitize_text_field( $_POST["pp-title"]);
    $panelDescription = esc_textarea( $_POST["pp-description"]);
    $panelOutline = esc_textarea( $_POST["pp-outline"]);

    $panelSuccess = $panel_query->execute();

    //Close the connection

    $conn->close();

    if($panelistSuccess && $copanelistSuccess && $panelSuccess){
        echo "Your panel submission has been recieved. An email has been sent to ".$email."<br />";
        echo "If you have any questions or concerns, please send an email to josh.sorenson@ndkdenver.org";
    }else{
        echo "There was an issue with your panel submission. (Probably on our side)<br />";
        echo "please send an email to josh.sorenson@ndkdenver.org and we'll get it sorted out.";
    }

}
function panel_planner_send_mail_stage2(){

}

?>


