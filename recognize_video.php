<?php
include "index.php";
?>

<?php
$dir="uploaded_video";
$file=scandir($dir);
if($file[2]){
unlink('uploaded_video/'.$file[2]);
}
?>

<div class=content>
<div class=data>
<div class=inner-data>

<center><h1><u>Face Recognition System</u></h1></center>
<br>
Upload a video to recognize faces from the photos uploaded before.<br>
The people whose embeddings are saved are:<br>
<br>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "face_recognition";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name FROM encodings";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
<br>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file" /> 
<button class="btn btn-primary" type="submit" name="submit">Upload</button>
</form>

<?php
if(isset($_POST["submit"])) {

$allowedExts = array("mp4","avi");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if (($_FILES["file"]["type"] == "video/mp4")

&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))

  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
     
    if (file_exists("upload/".$_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploaded_video/". $_FILES["file"]["name"]);
      echo "File uploaded Successfully!";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
}
?>
<br>
<a href=recognition_video.php><button class="btn btn-info">Recognize in video</button></a>
</div>
</div>
</div>
<style>
body{
background-color:rgb(230,230,230);
}
.content{
margin-top:51px;
}
.data{
margin:40px;
margin-top:60px;
background-color:rgb(200,200,200);
}
.inner-data{
margin:40px;
font-size:20px;
}
</style>
