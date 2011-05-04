<?php
$message = '';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
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
	<form name="tokennotcheckedform" method="post">
		<input type="text" name="email" />
		<input type="hidden" name="token" value="randomtokenxyz" />
	</form>
</body>
</html>