<?php

// exit immediately if the data url was not passed.
  if (!isset($_REQUEST['data_url'])) {
  	  echo 'Data not passed!';

    exit();
  }
 
	echo 'Data passed'; 
  // Get the data url.
  $img = $_REQUEST['data_url'];
 
  // Clean up the data url string a bit.
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  
  // Decode the image.
  $decodedImage = base64_decode($img);
  
  // Generate a random filename.
  $filename = md5(time()).'.png';
  
// Create connection
$con=mysqli_connect("abilitex.com","csc342","bL1nk","csc342");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,"INSERT INTO pictures (TITLE, DESCRIPT, FILE)
VALUES ('Pic', 'stuff is in here', filename)");


mysqli_close($con);
?>