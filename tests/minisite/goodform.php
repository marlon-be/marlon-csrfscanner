<?php
$message = '';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST['token'] != 'randomtokenxyz') {
		header("HTTP/1.0 403 Forbidden");
		die('invalid token');
	}

	// ... store email

	$message = 'Success';
}

?>
<html>
<head>
<title>Good Form</title>
</head>
<body>
	<p><?php echo $message ?></p>
	<form name="goodform" method="POST">
		<input type="text" name="email" />
		<input type="hidden" name="token" value="randomtokenxyz" />
		<button name="somebutton">Some button</button>
		<input type="button" name="inputwithtypebutton" />
		<input type="submit" name="inputwithtypesubmit" />
		<input type="image" name="inputwithtypeimage" />
	</form>
	<br />
	<ul>
		<li><a href="goodform.php">Good form</a></li>
		<li><a href="notokenform.php">Form without token</a></li>
		<li><a href="tokennotcheckedform.php">Token not checked</a></li>
		<li><a href="nestedpage.php">Nested page</a></li>
		<li><a href="nestedpage.php#foo">Fragments (the part behind the #) should be ignored</a></li>
		<li><a href="nestedpage.php#bar">Fragments (the part behind the #) should be ignored</a></li>
	</ul>

	<form name="bogusform" method="POST">
	</form>
</body>
</html>