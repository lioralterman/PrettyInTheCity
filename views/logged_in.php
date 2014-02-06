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
  document.write("latitude: " + position.coords.longitude + 
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
<a href="index.php"><div id="topMenu"><img class="logo" src="images/logo.png" /></div></a>
<?php 
		function getTop(){
			// creating a database connection
            $db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$db_connection->connect_errno) {
				if(!(isset($_SESSION["longitude"]) && isset($_SESSION["latitude"]))){
					$_SESSION["latitude"] = $_GET["latitude"];
					$_SESSION["longitude"] = $_GET["longitude"];
					$db_connection->query("UPDATE users SET user_latitude=".$_SESSION["latitude"].", user_longitude=".$_SESSION["longitude"]."WHERE user_email='".$_SESSION["user_email"]."';");
				}
				//$query_top = $db_connection->query("SELECT * FROM users;");
				/*$query="set @orig_lat=122.4058; set @orig_lon=37.7907;set @dist=10000;SELECT *,3956 * 2 * ASIN(SQRT( POWER(SIN((@orig_lat -abs(user_latitude)) * pi()/180 / 2),2) + COS(@orig_lat * pi()/180 ) * COS( abs(user_latitude) * pi()/180) * POWER(SIN((@orig_lon - user_longitude) *  pi()/180 / 2), 2) ))as distance FROM users dest having distance < @dist ORDER BY distance limit 10;";*/
				$query = "SELECT * FROM users;";
$query_top = $db_connection->query($query);

				
				$i=1;
				while($row = mysqli_fetch_array($query_top))
  {
  echo '<div class="image" style="background-image:url(\''.$row['user_image'].'\')"><div class="imageText"><span class="imageNum">'.$i.'</span><span class="imageName">'.$row['user_name'].' '. getAge($row["user_birth"]).'years old, '.getDistance($row["user_latitude"], $row["user_longitude"],$_SESSION["latitude"],$_SESSION["longitude"],"k").'km</span></div></div>';
  $i++;
  }
			} else {
				$errors[] = "Sorry, no Database connection";
			}
		}
		
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
    return (round($miles * 1.609344));
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

 if ((isset($_GET["latitude"]) && isset($_GET["longitude"])) || (isset($_SESSION["latitude"]) && isset($_SESSION["longitude"]))) {
                getTop();
 }
 else{
	 echo('<script>if(navigator.geolocation){navigator.geolocation.getCurrentPosition(function(position){document.location = "index.php?latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude;});}</script>');
	 echo("<h1>Please turn on geolocation</h1>");
 }
?>
<a href="smash.php">
<div class="smashing"><img src="images/smashing.png" id="glove" /></div>
</a> <a href="#">

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
</body>
</html>
