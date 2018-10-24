<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Task 2 - Post Status Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
form {
	margin-left: 20px;
}

input {
	margin: 8px;
	border: 1px solid #ccc;
	border-radius: 4px;
}
</style>
</head>

<body>
	<h1 align="center">Status Posting System</h1>

	<form action=" poststatusprocess.php" method="post">

		<!-- set Status Code and Status as mandatory fields by using "required". -->
		Status Code (required): <input type="text" name="scode" required><br>
		Status (required): <input type="text" name="status" required><br> <br>

		Share: <input type="radio" name="share" value="public"> <label>Public</label>
		<input type="radio" name="share" value="friends"> <label>Friends</label>
		<input type="radio" name="share" value="onlyme"><label>Only me</label><br>

		<!-- use date() function to initially contain the current date. -->
		Date: <input type="text" name="date"
			value="<?php echo date("d/m/Y"); ?>"><br>

		<!-- add three checkboxes of permission type. -->
		Permission Type: <input type="checkbox" name="ptype[]"
			value="Allow like"> <label>Allow Like</label> <input type="checkbox"
			name="ptype[]" value="Allow comment"> <label>Allow Comment</label> <input
			type="checkbox" name="ptype[]" value="Allow share"> <label>Allow
			Share</label><br> <input type="submit" value="Post">

	</form>
	<br>

	<div style="margin-left: 20px">
		<a href="index.html">Return to Home Page</a>
	</div>

</body>
</html>