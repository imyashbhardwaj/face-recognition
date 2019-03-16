
<?php
include "index.php";
?>
<div class=content>
<div class=data>
<div class=inner-data>
<center><h1><u>Face Recognition System</u></h1></center>

<br>

Generate Embeddings for the uploaded image:<br> <br>

<div class=embedd>
The files available are:<br>
<br>
<?php
$dir = "faces/";
$files = scandir($dir);
for($i=2;$i<count($files);$i++)
print($files[$i]."<br>")
?>
<br>
Enter the name of file you want to generate face embeddings for:<Br>
<form action=generate_embeddings.php method=GET>
<input type=text name=file placeholder="Enter file name..."/>
<button class="btn btn-info" type=submit id=embeddings> Generate Embeddings</button>
</form>
</div>
<br>
<br>
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

<script language=javascript>

</script>
