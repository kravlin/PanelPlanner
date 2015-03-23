
<?php
// This page is supposed to lay out one of the pages for accepting/rejecting a panel.
	global $wpdb;

	function panel_planner_show_panel($panelID) {
		$panel = $wpdb->get_row( 'SELECT panelName FROM panel_planner where panelID = '.$panelID, ARRAY_A );
		if ($panel != null){
			echo "<head><title>Viewing Panel ".$panelname."</title></head>";
			echo "<body>";
			echo "<h1>Panel ".$panelname."</h1><br>";
			echo "Stage: ".$stage."<br><br>";
			echo "Panel Submission #: ".$panelID."<br><br>";
			echo "<h1>Panel ".$panelname."</h1><br><br>";
			echo "Panel Submission #: ".$panelID."<br><br>";
			echo "Panelist Name: ".$panelistFirstname." ".$panelistLastname."<br>";
			echo "Panelist Email: ".$panelistEmail."<br>";
			echo "Panelist Age: ".$panelistAge."<br><br>";
			if ($hasCopanelist){
			echo "CoPanelist Name: ".$copanelistFirstname." ".$copanelistLastname."<br>";
			echo "CoPanelist Email: ".$copanelistEmail."<br>";
			echo "CoPanelist Age: ".$copanelistAge."<br><br>";
			}
			if($stage == 1) {
				echo "Panel Title<br>";
				echo "<br>".$panelTitle;
				echo "Panel Description<br>";
				echo "<br>".$panelDesc;
				echo "Panel Outline<br>";
				echo "<br>".$panelOutline;
				echo "<br>";
				echo '<form action="panelplanner-viewpanel.php" method="post">';
				echo '<p><input type="hidden name="pp-panelID value='.$panelID.'/></p>';
				echo '<p><input type="submit" name="pp-submitted" value="Accept"/></p>';
				echo '<p><input type="submit" name="pp-submitted" value="Reject"/></p>';
				echo '</form>';
			} elseif ($stage == 2) {
				echo "";
			}

			echo "</body>";
		}else{
			echo "No Panel Found";
		}
	}
?>