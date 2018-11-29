<?php
session_start();
$_SESSION["m_race"] = 11;
$_SESSION["m_gender"] = 1;
$_SESSION["m_class"] = 3;
$_SESSION["m_hair_style"] = 2;
$_SESSION["m_skin_style"] = 4;
$_SESSION["spaulders"] = 65202;
$_SESSION["chest"] = 65198;
$_SESSION["wrist"] = 52428;
$_SESSION["hands"] = 65188;
$_SESSION["belt"] = 49258;
$_SESSION["legs"] = 65203;
$_SESSION["boots"] = 61173;
$_SESSION["mainhand"] = 45479;
$_SESSION["offhand"] = 45481;
$_SESSION["shirt"] = 10058;
$_SESSION["tabard"] = 58701;
?> 
<div id="model_scene" align="center"> 
<object id="wowhead" type="application/x-shockwave-flash" data="./models/flash/ModelViewer3.swf" height="580px" width="480px"> 
<param name="quality" value="high"> 
<param name="allowscriptaccess" value="always"> 
<param name="menu" value="false"> 
<param value="transparent" name="wmode"> 
<param name="flashvars" value="fileServer=models/&modelUrl=/get_model.php"> 
<param name="movie" value="./models/flash/ModelViewer3.swf"> 
</object> 
</div>