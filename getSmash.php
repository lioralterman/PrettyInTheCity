<?php

/**
 * A simple, clean and secure PHP Login Script
 * 
 * ADVANCED VERSION
 * (check the website / github / facebook for other versions)
 * 
 * A simple PHP Login Script without all the nerd bullshit.
 * Uses PHP SESSIONS, modern SHA512-password-hashing and salting
 * and gives the basic functions a proper login system needs.
 * 
 * @package php-login
 * @author Panique <panique@web.de>
 * @link https://github.com/panique/php-login/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
require_once("libraries/password_compatibility_library.php");

// include the configs / constants for the database connection
require_once("config/db.php");

// include the hashing cost factor (you can delete this line if you have never touched the cost factor,
// the script will then use the standard value)
require_once("config/hashing.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    //include("views/smash.php");
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // if no connection errors (= working database connection)
            if (!$db_connection->connect_errno) {
	$id = array();
	
	$result = $db_connection->query("SELECT * FROM users;");

        while($row = mysqli_fetch_array($result))
  		{
			$users["user_id"][] = $row['user_id'];
			$users["user_name"][] = $row['user_name'];
			$users["user_distance"][] = getDistance($_SESSION['latitude'],$_SESSION['longitude'],$row['user_latitude'],$row['user_latitude'],"k");
			$users["user_age"][] = getAge($row['user_birth']);
			$users["user_image"][] = $row['user_image'];
		}
		echo(json_encode($users));
			}
} else {
	echo "Not logged in";
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    //include("views/not_logged_in.php");
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
