<?php
include "index.php";
?>
<div class=content>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>	
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="https://cdn-images-1.medium.com/max/1600/1*WxBM1lB5WzDjrDXYfi9gtw.gif" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption">
          
        </div>
      </div>

      <div class="item">
        <img src="https://cdn-images-1.medium.com/max/1600/1*AbEg31EgkbXSQehuNJBlWg.png" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
          
        </div>
      </div>
    
      <div class="item">
        <img src="https://cdn-images-1.medium.com/max/1600/1*6kMMqLt4UBCrN7HtqNHMKw.png" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          
        </div>
      </div>

<div class="item">
        <img src="https://cdn-images-1.medium.com/max/1600/1*igEzGcFn-tjZb94j15tCNA.png" alt="New York" style="width:100%;">
        <div class="carousel-caption">
          </div>
      </div>
 
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<h1 align=center><u>Face Recognition</u></h1>
<div class=data>
<div class=inner-data>
<br>
This is a Face Recognition system which is currently configured to recognize faces from the images which the user uploads.
<Br>
<br>
Softwares Used:
<ul>
<li>dlib
<li>OpenCV
<li>Python 2.x
</ul>
<br>
</div>
</div>
</div> <!-- content class-->
</body>

<style>
.inner-data{
margin:40px;
}
.data{
margin:0px 40px 0px 40px;
background-color:rgb(200,200,200);
}
.content{
margin-top:51px;
}
#myCarousel img{
width:100%;
height:500px;
}
#myCarousel{
border-style:solid;
border-width:0px;
border-color:orange;
}
body{
background-color:rgb(230,230,250);
font-size:20px;
}
</style>

