<?php
include "index.php";
//$path=pathinfo($_GET["file"]);
//echo $path['filename'];
?>
<div class=content>
<div class=data>
<div class=inner-data>
<center><h1><u>Face Recognition System</u></h1></center>
<?php
$m=$_GET["file"];

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
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO encodings (Name, Encoding)
VALUES ('".$_GET["file"]."', '".$embedding."')";

if (mysqli_query($conn, $sql)) {
    echo "<br>Encoding saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
<Br>
<Br>

Click to go to <a href=#>recognition</a>.
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

