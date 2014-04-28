<html>
<head>
<title>PHP Test</title>
</head>
<body>
<?php echo '<p>Hello World</p>'; ?>
<?php
// Create connection
$con=mysqli_connect("abilitex.com","csc342","bL1nk","csc342");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = mysqli_query($con, "SELECT * FROM pictures");
echo $query;
?> 
</body>
</html>