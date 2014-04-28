<?php
$img = $_POST['imgBase64'];

 // Clean up the data url string a bit.
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  
  // Decode the image.
  $decodedImage = base64_decode($img);
  
  // Generate a random filename.
  $filename = 'captured/'.md5(time()).'.png';
  
//$filteredData = explode(',', $rawData);
 
 

//$unencoded = base64_decode($filteredData[1]);
//$randomName = rand(0, 99999);;

//Create the image 
$fp = fopen($filename, 'w');
//fwrite($fp, $unencoded);
fwrite($fp, $decodedImage);
fclose($fp);

$pictureTitle = $_POST['pictureTitle'];
//echo $pictureTitle;
$pictureDescription = $_POST['pictureDescription'];
//echo $pictureDescription;

//Create the image 
$fp = fopen('test.txt', 'w');
//fwrite($fp, $unencoded);
fwrite($fp, $pictureTitle);
fclose($fp);
 
// Create connection
$con=mysqli_connect("abilitex.com","csc342","bL1nk","csc342");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


//table PICTURES. Columns: TITLE, DESCRIPT, FILE, FILENAME, DATE, USER, 
$query = mysqli_query($con,"INSERT INTO PICTURES (TITLE, DESCRIPT, FILENAME)
VALUES ('$pictureTitle', '$pictureDescription', '$filename') ");

if ( $query === false ){
     echo 'Error on insert';
}
  	  
mysqli_close($con);

?> 