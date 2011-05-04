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
<title>No Token Form</title>
</head>
<body>
	<p><?php echo $message ?></p>
	<form name="notokenform" method="post">
		<input type="text" name="email" />
	</form>
	<br />
	<ul>
		<li><a href="goodform.php">Good form</a></li>
		<li><a href="notokenform.php">Form without token</a></li>
		<li><a href="tokennotcheckedform.php">Token not checked</a></li>
	</ul>
</body>
</html>