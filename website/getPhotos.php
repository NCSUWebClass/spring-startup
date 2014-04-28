

<?php


// Create connection
$con=mysqli_connect("abilitex.com","csc342","bL1nk","csc342");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

class Pic
{
    public $title;
    public $description;
    public $imgfile;

}

//$myPic = new Pic();

$i= 0;

$pictures[] = null;


$query = mysqli_query($con, "SELECT * FROM PICTURES");


$filename;

$i = 0;
$myString == "";

$pictures[] = null;
while ($row = $query->fetch_assoc())
{
	$title=  $row['TITLE'];
	//$myPic->description = $row['DESCRIPT'];
	$filename =  $row['FILENAME'];
	
	
    //$pictures[$filename] = $title;
	
	//$myString = $myString. 'Picutre title is ' .$pictures[i]->title . '  '. $pictures[i]->description. '  '. $pictures[i]->imgfile = $row['FILENAME']; 
	
	if($myString == ""){
		$myString = $title. '^'. $filename ;
	}
	else{	
	$myString =  $myString. '~'. $title. '^'. $filename ;
	}
	//$i++;

//echo $pictures[$filename];
}

echo $myString;


//echo json_encode('hello, coo, pooo, pppp');




?> 
