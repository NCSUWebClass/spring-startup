
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Blink by LifeLoop</title>
<link href="style.css" rel="stylesheet" type="text/css">


<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <style>
    #webcam, #screenshot-canvas
        {
            margin: 2em auto 0;
            width: 500px;
            padding: 2em;
            background: white;
            -webkit-box-shadow: 0 1px 10px #D9D9D9;
            -moz-box-shadow: 0 1px 10px #D9D9D9;
            -ms-box-shadow: 0 1px 10px #D9D9D9;
            -o-box-shadow: 0 1px 10px #D9D9D9;
            box-shadow: 0 1px 10px #D9D9D9;
        }
    </style>
    <script>
        function onFailure(err) {
            alert("The following error occured: " + err.name);
        }
        jQuery(document).ready(function () {

            var video = document.querySelector('#webcam');
            var button = document.querySelector('#screenshot-button');
            var canvas = document.querySelector('#screenshot-canvas');
            var ctx = canvas.getContext('2d');

            navigator.getUserMedia = (navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia);
            if (navigator.getUserMedia) {
                navigator.getUserMedia
                            (
                              { video: true },
                              function (localMediaStream) {
                                  video.src = window.URL.createObjectURL(localMediaStream);
                              }, onFailure);
            }
            else {
                onFailure();
            }
            button.addEventListener('click',snapshot, false);
            
            function snapshot() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0);
				// save canvas image as data url (png format by default)
				var dataURL = canvas.toDataURL();
				document.getElementById('canvasImg').src = dataURL;
				
				jQuery.post("http://abilitex.com/capture.php", dataURL, onUploadSucess);
				
				function onUploadSuccess(){
					alert('picture uploaded');
				}
            }
        });

        
    </script>
  
 
  
</head>

<body>

<div class="container">
  <div class="header"><a href="index.html"><img src="images/lifeloop_logo.jpg" alt="LyfeLoop Logo" name="lyfeloop_logo" width="100%"id="lyfeloop_logo" /></a> 
    <!-- end .header -->
  </div>
  
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="capture.html">Capture</a></li>
      <li><a href="view.html">View</a></li>
      <li><a href="about.html">About Us</a></li>
      <li><a href="contact.html">Contact Us </a></li>
    </ul>
 <!-- end .sidebar1 -->
  </div>
  
  <div class="content">
	<img id="canvasImg" alt="Right click to save me!">
    <h1>Welcome to Blink by LyfeLoop</h1>
    <p>Take a picture and enter a title to save your moment on Blink!</p>
  <form method="post">
Picture Title </br>
<input type="text" NAME="pictureTitle"> </br>
Picture Description </br>
<textarea rows="4" cols="50" name="pictureDescription">
</textarea>


	<video id="webcam" autoplay >
     	   </video>
     	   <canvas id="screenshot-canvas">
       	 </canvas>
       	 <p>
         <button id="screenshot-button">
        Capture</button>
</div>
</form>
  
  <div class="footer">
    <p>    
      <a href="capture.html">Capture</a>
      <a href="view.html">View</a>
      <a href="about.html">About Us</a>
      <a href="contact.html">Contact Us </a>
    </p>
    <p>&copy;LifeLoop· 
    Raleigh, NC</p>
    </div>
  </div>
  
  
  <?php
  $pictureTitle = " DEFINE THIS";

// exit immediately if the data url was not passed.
/*
  if (!isset($_REQUEST['dataURL'])) {
  	  echo 'Data not passed!!!!!';

    exit();
  } 
 */
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

$pictureTitle = $_POST['pictureTitle'];
echo $pictureTitle;
$pictureDescription = $_POST['pictureDescription'];
echo $pictureDescription;

//table PICTURES. Columns: TITLE, DESCRIPT, FILE, FILENAME, DATE, USER, 
$query = mysqli_query($con,"INSERT INTO PICTURES (TITLE, DESCRIPT)
VALUES ('$pictureTitle', '$pictureDescription')");

if ( $query === false ){
     echo 'Error on insert';
}
  	  
mysqli_close($con);
?>
</body>
</html>
