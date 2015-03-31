<?php

    //response generation
    
    function panel_planner_save_input_stage1(){
    
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
?>

<script type="text/Javascript">
    function show_hide(element1, element2)
        if (document.getElementById(element2).checked){
            document.getElementById(element1).style.display = "";      
       }
        else{
            document.getElementById(element1).style.display = "none";
        }
    }
</script>
    
<!-- End Javascript / Begin Basic styling for errors -->
    
<style type="text/css">

.error{
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
}

.success{
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
}
  form span{
    color: red;
  }
</style>
<!-- End errors -->

    <?php get_header(); ?> 
    <div id="primary" class="site-content">
    <div id="content" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
    <?php the_content(); ?>

    <form action="panelplanner-stage1.php" method="post">

    <!-- Begin Panelist -->

    <p>
    First Name (required) <br />
    <input type="text" name="pp-first-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name"] ) ? esc_attr( $_POST["pp-first-name"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Last Name (required) <br />
    <input type="text" name="pp-last-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name"] ) ? esc_attr( $_POST["pp-last-name"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Email Address (required) <br />
    <input type="email" name="pp-email" value="' . ( isset( $_POST["pp-email"] ) ? esc_attr( $_POST["pp-email"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Age (required) <br />
    <input type="text" name="pp-age" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age"] ) ? esc_attr( $_POST["pp-age"] ) : '' ) . '" size="40" />
    </p>

    <!-- End Panelist -->
    
    <p>
    <input type="checkbox" checked="false" id="pp-hasCopanelist" onchange="javascript:show_hide(\'CoPanelist\',\'pp-hasCopanelist\');"/> I have a CoPanelist.
    </p>

    <!-- Begin Copanelist -->
    
    <div id="CoPanelist" style="display: none" >
    <p>
    First Name (required) <br />
    <input type="text" name="pp-first-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-first-name2"] ) ? esc_attr( $_POST["pp-first-name2"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Last Name (required) <br />
    <input type="text" name="pp-last-name2" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["pp-last-name2"] ) ? esc_attr( $_POST["pp-last-name2"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Email Address (required) <br />
    <input type="email" name="pp-email2" value="' . ( isset( $_POST["pp-email2"] ) ? esc_attr( $_POST["pp-email2"] ) : '' ) . '" size="40" />
    </p>
    <p>
    Age (required) <br />
    <input type="text" name="pp-age2" pattern="[0-9]+" value="' . ( isset( $_POST["pp-age2"] ) ? esc_attr( $_POST["pp-age2"] ) : '' ) . '" size="40" />
    </p>
    </div>

    <!-- End Copanelist / Begin Panel -->

    <p>
    Panel Title (required) <br />
    <input type="text" name="pp-title" value="' . ( isset( $_POST["pp-title"] ) ? esc_attr( $_POST["pp-title"] ) : '' ) . '" size="40" />
    </p>
    Short Panel Description (required) <br />
    <textarea rows="10" cols="35" name="pp-description">' . ( isset( $_POST["pp-description"] ) ? esc_attr( $_POST["pp-description"] ) : '' ) . '</textarea>';
    </p>
    <p>
    Detailed Panel outline (required) <br />
    <textarea rows="10" cols="35" name="pp-outline">' . ( isset( $_POST["pp-outline"] ) ? esc_attr( $_POST["pp-outline"] ) : '' ) . '</textarea>';
    </p>
    <p><input type="submit" name="pp-submitted" value="Send"/></p>
    </form>

    </div><!-- .entry-content -->
    </article><!-- #post -->
    <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
    
    <!-- End Panel -->