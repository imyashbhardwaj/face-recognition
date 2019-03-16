<?php
include "index.php"
?>
<?php
$dir="recognized_video";
$file=scandir($dir);
if($file[2]){
unlink('recognized_video/'.$file[2]);
}
?>

<div class=content>
<div class=data>
<div class=inner-data>
<center><h1><u>Face Recognition System</u></h1></center>
<br><Br>
<?php
$dir = "uploaded_video/";
$files = scandir($dir);
$m=$files[2];
$result= `python /opt/lampp/htdocs/face/python/recognize_video.py /opt/lampp/htdocs/face/uploaded_video/{$m} 2>&1`;
?>
<center>
<video width="900" height="500" id=vid controls>
<source src="recognized_video/output.mp4" type="video/mp4">

</video>
<br>
<a href="recognized_video/output.mp4" download><button class="btn btn-primary">Download</button></a>
</center>
</div>
</div>
</div>
<script language=Javascript>
var a= "output.avi";
var html=" <source src='recognized_video/output.mp4' type='video/mp4'>"
$("#vid").html(html);
</script>
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
