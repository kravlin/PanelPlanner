<html>
	<head>
		<title>Starting Version Demo Page</title>
	</head>
	<body>

<?php
	echo '<p>You</p>';
	echo '<form>'.
		 'First name: <input type="text" name="panelist_firstname"><br>'.
		 'Last name: <input type="text" name="panelist_lastname"><br>'.
		 'Your Email Address: <input type="text" name="panelist_email"><br>'.
		 'Age:'.
		 '<input type="radio" name="age">16-17 <br>'.
		 '<input type="radio" name="age" value="18+">18+<br>'.
		 '<input type="submit" value="Submit"><br>'.
		  '</form>'
?>
	</body>
</html>
