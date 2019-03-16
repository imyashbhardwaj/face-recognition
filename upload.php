<?php
include "index.php";
?>
<div class=content>
<div class=data>
<div class=inner-data>
<center><h1><u>Face Recognition System</u></h1></center>
Upload the Photo here:<br><br>
<form action="" method="POST" enctype="multipart/form-data">
Name:<input name="name" type=text />
<div id="wrapper" style="margin-top: 20px;">
<div id="image-holder"></div>

<input type=file name="fileToUpload" id="fileToUpload">
<button class="btn btn-primary" name=button1 type=submit>Upload</button>
</div>
<br>
<div style="color:rgb(200,0,0)">*The file should have only one face in it</div>
</form>


<script>
$(document).ready(function() {
        $("#fileToUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });$
      });
</script>
<div id=php>
<?php
if (isset($_POST['button1']))
{

$target_dir = "faces/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        //echo "Sorry, there was an error uploading your file.";
    }
}

$m=$target_file;

$embedding = `python python/generate_embeddings.py {$m} 2>&1`;
																																																																																																																				
//echo $embedding;

if($embedding){
echo "<br>Encodings generated!";																																																																																																																																																																																																																																																																													 

}																																																																																					
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "face_recognition";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$name=$_POST["name"];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO encodings (Name, File_name, Encoding)
VALUES ( '".$name."','".basename($_FILES["fileToUpload"]["name"])."', '".$embedding."')";

if (mysqli_query($conn, $sql)) {
    echo "<br>Encoding saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);





}
?>

</div><br>

<br>
<br>
</div>
</div>
</div>
<style>
.thumb-image{
 //float:left;
 height:200px;
 width:200px;
 position:relative;
 padding:5px;
}
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

<script language=javascript>

</script>
