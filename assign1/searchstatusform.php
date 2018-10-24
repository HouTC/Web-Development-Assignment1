<html>
<head>
<title>Task 4 - Search Status Page</title>
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

	<form method="get" action="searchstatusprocess.php">
		<lable>Status: <input type="text" name="status"></lable>
		<input type="submit" value="View Status">
	</form>

	<div style="margin-left: 20px">
		<a href='poststatusform.php'>Go to Post Status Page</a><br>
		<br> <a href='index.html'>Return to Home Page</a>
	</div>
	
	<br>
	<img src="images/search.jpeg" alt="Seaching image" style="width: 100%;">
	
</body>
</html>