<!-- 
/
<div>
    <!-- if you need users's information, just put them into the $_SESSION variable and output them here 
    Hey, <!php echo $_SESSION['user_name']; ?>. You are logged in.<br />
    Try to close this browser tab and open it again. Still logged in! ;)<br />
    And here's your profile picture (from gravatar):<br />
    <!php //echo $login->user_gravatar_image_url; ?>
    <!php echo $login->user_gravatar_image_tag; ?>
</div>

<div>
    <!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true"
    <a href="index.php?logout">Logout</a>    
    <a href="edit.php">Edit user data</a>
</div>

<!-- this is the Simple sexy PHP Login Script. You can find it on http://www.php-login.net ! It's free and open source. -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretty In The City</title>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
html, body {
  overflow: hidden;
}
.divs{
	width: -moz-fit-content;
    width: -webkit-fit-content;
    width: fit-content;
    margin: auto;
}
</style>
</head>

<body>
<script>
/*
getLocation();
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.watchPosition(showPosition);
    }
  else{document.write("Geolocation is not supported by this browser.");}
  }
function showPosition(position)
  {
  document.write("Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude);	
  }
  */
  /*
  set @orig_lat=122.4058; set @orig_lon=37.7907;set @dist=10;
SELECT *,
 
3956 * 2 * ASIN(SQRT( POWER(SIN((@orig_lat -
abs( 
dest.lat)) * pi()/180 / 2),2) + COS(@orig_lat * pi()/180 ) * COS( 
abs
(dest.lat) *  pi()/180) * POWER(SIN((@orig_lon – dest.lon) *  pi()/180 / 2), 2) ))
 
as distanceFROM hotels desthaving distance < @distORDER BY distance limit 10;
*/
</script>
<div id="topMenu"><a href="index.php"><img src="images/logo.png" /></a></div>
<?php 

		function getAge($birthDate){
         $birthDate = explode("-", $birthDate);
         //get age from date or birthdate
         $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
         return $age;
		}
		
		function getDistance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

 if ((isset($_GET["latitude"]) && isset($_GET["longitude"])) || (isset($_SESSION["latitude"]) && isset($_SESSION["longitude"]))) {
                //getSmash();
 }
 else{
	 echo('<script>if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(position){document.location = "smash.php?latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;});}</script>');
	 echo("<h1>Please turn on geolocation</h1>");
 }
?>
<a href="#">
<div class="topProfile">
<!--
<img class="topProfileImage" src="<php echo $_SESSION["user_image"] ?>"/><span class="topProfileName"><php echo $_SESSION["user_name"]></span>
-->
<div id='cssmenu'>
<ul>
   <li class='has-sub last'><a href='#'><span><img class="topProfileImage" src="<?php echo $_SESSION["user_image"] ?>"/><?php echo $_SESSION["user_name"]?></span></a>
      <ul>
         <li><a href='#'><span>View Profile</span></a></li>
         <li><a href='#'><span>Edit Profile</span></a></li>
         <li class='last'><a href='index.php?logout'><span>Log Out</span></a></li>
      </ul>
   </li>
</ul>
</div>

</div>
</a>
<img src="images/smash.png" /><br /><br />

<a href="javascript:sendSmash(0);">
<div id="smash0" class="image1" style="display:inline-block"><div class="imageText1"><span id="name0" class="imageName"></span> <span id="age0" class="imageName"></span> <span id="distance0" class="imageName"></span></div></div>
</a>
<div id="glove0" style="position:absolute; z-index:1; top:800px; left:280px"><img src="images/glove0.png" /></div>
<a href="javascript:sendSmash(1);">
<div id="smash1" class="image2" style="display:inline-block"><div class="imageText1"><span id="name1" class="imageName"></span> <span id="age1" class="imageName"></span> <span id="distance1" class="imageName"></span></div></div>
</a>
<div id="glove1" style="position:absolute; z-index:1; top:800px; right:280px"><img src="images/glove1.png" /></div>

<script>
var first = true;
var users;
usersId=[];
usersNames=[];
usersImage=[];
usersBirth=[];
usersAltitude=[];
usersLatutide=[];
user_id=Array();
user_name=Array();
user_age=Array();
user_image=Array();
user_distance=Array();
function sendSmash(num)
{
	var id1=user_id[num];
	var id2=user_id[1-num];
	smash(1-num);
var xmlhttp;
if (id1.length==0 || id2.length==0)
  { 
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //////////////////////////////////////////alert(xmlhttp.responseText);
    }
  }
xmlhttp.open("POST","sendSmash.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id1="+id1+"&id2="+id2);
xmlhttp.send();
}

function getSmash()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    users=JSON.parse(xmlhttp.responseText);
		buildFirstSmash();
    }
  }
xmlhttp.open("GET","getSmash.php",true);
xmlhttp.send();
}

function buildFirstSmash(){
	for(i=0;i<2;i++){
		user_id[i]=users["user_id"].pop();
		user_name[i]=users["user_name"].pop();
		user_age[i]=users["user_age"].pop();
		user_image[i]=users["user_image"].pop();
		user_distance[i]=users["user_distance"].pop();
		
	//	$("#id"+i).text(user_id[i]);
	$("#name"+i).text(user_name[i]);
	$("#age"+i).text(user_age[i]);
	$("#distance"+i).text(user_distance[i]);
	$("#smash"+i).css("background-image","url("+user_image[i]+")");
	}
	first=false;
}

function buildSmash(i){
	if(user_id.length>0){
		user_id[i]=users["user_id"].pop();
		user_name[i]=users["user_name"].pop();
		user_age[i]=users["user_age"].pop();
		user_image[i]=users["user_image"].pop();
		user_distance[i]=users["user_distance"].pop();
		
	//	$("#id"+i).text(user_id[i]);
	$("#name"+i).text(user_name[i]);
	$("#age"+i).text(user_age[i]);
	$("#distance"+i).text(user_distance[i]);
	$("#smash"+i).css("background-image","url("+user_image[i]+")");
	}
	else{
		getSmash();
	}

}

function smash(num){
	$("#glove"+num).animate({top:'350px'}, function(){$( "#smash"+num ).toggle( "explode", { pieces: 16}, 300);}).animate({top:'800px'}, function(){$( "#smash"+num );buildSmash(num);$( "#smash"+num ).fadeIn();});
	
	//$( "#smash"+num ).toggle( "explode" );
	//$( "#smash"+(1-num) ).toggle( "explode",{pieces:64} );
	//$( "#smash"+num ).toggle( "explode" ).toggle( "explode" );
	//buildSmash();
		//$( "#smash"+num ).toggle( "explode" );
	//$( "#smash"+(1-num) ).toggle( "explode" );
}

getSmash();
</script>

</body>
</html>
