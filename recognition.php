<?php
include "index.php";
?>
<div class=content>
<div class=data>
<div class=inner-data>
<center><h1><u>Face Recognition System</u></h1></center>
<br><Br>
<div id=recognize>
</div>
<center>
<?php
$dir = "recognition-face/";
$files = scandir($dir);
$m=$files[2];
$k='recognition-face/'.$m; 
copy($k,'recognized/'.$m); 
?>
<script language=Javascript>
var a= "<?php $dir = 'recognition-face/'; $files = scandir($dir); echo $files[2];  ?>";
console.log(a);
var html="<center><img height=500px width=500px src='recognized/"+a+"' />"
console.log(html)
$("#recognize").html(html);
</script>
<?php
$dir = "recognition-face/";
$files = scandir($dir);
$m=$files[2];
$result= `python /opt/lampp/htdocs/face/python/recognition.py /opt/lampp/htdocs/face/recognition-face/{$m} 2>&1`;
echo "<br>".$result;
?>
</center>
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
