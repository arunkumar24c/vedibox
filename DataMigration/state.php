<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form action="DB-Connect/excel-connect-state.php" method="post" enctype="multipart/form-data">
	
	<input type="file" name="exceldata"><br/><br/>
	<input type="submit" value="Load Data">
	
</form>
	<br/><br/><br/><br/><br/><br/>
	<h3>Lead Data</h3>
	
<form action="DB-Connect/excel-connect-lead.php" method="post" enctype="multipart/form-data">
	
	<input type="file" name="exceldata"><br/><br/>
	<input type="submit" value="Load Data">
	
</form>
	
	<br/><br/><br/><br/><br/><br/>
	<h3>Customer Data</h3>
	
<form action="DB-Connect/excel-connect-customer.php" method="post" enctype="multipart/form-data">
	
	<input type="file" name="exceldata"><br/><br/>
	<input type="submit" value="Load Data">
	
</form>
	</body>
</html>