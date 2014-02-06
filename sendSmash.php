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
if ($login->isUserLoggedIn() == true && isset($_POST['id1']) && isset($_POST['id2'])) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    //include("views/smash.php");
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if (!$db_connection->connect_errno) {
	  $id1 = mysql_real_escape_string(htmlentities($_POST['id1'], ENT_QUOTES));
	  $id2 = mysql_real_escape_string(htmlentities($_POST['id2'], ENT_QUOTES));
	  
	  
	  $result = $db_connection->query("SELECT user_rating FROM users WHERE user_id = '".$id1."';");
  
		  while($row = mysqli_fetch_array($result))
		  {
			  $rating1 = $row['user_rating'];
		  }
		  
	  $result = $db_connection->query("SELECT user_rating FROM users WHERE user_id = '".$id2."';");
  
		  while($row = mysqli_fetch_array($result))
		  {
			  $rating2 = $row['user_rating'];
		  }
		  
	  if(isset($rating1) && isset($rating2)){
		  $chance_of_winning = abs((1 / ( 1 + pow(10, ( ($rating1 - $rating2) / 400) ) )) * 100); //percentage
		  $chance_of_losing = abs(100 - $chance_of_winning); //percentage
		  
		  //evaluate and output win and lose points
		  $k_factor = 32; //a common k factor
		  $win_points = round($k_factor *  ($chance_of_losing/100)); //k_factor * decimal number
		  $lose_points = round($k_factor * ($chance_of_winning/100)); //k_factor * decimal number
		  
		  $db_connection->query("UPDATE users SET user_rating=user_rating+".$win_points." WHERE user_id = '".$id1."';");
		  $db_connection->query("UPDATE users SET user_rating=user_rating-".$lose_points." WHERE user_id = '".$id2."';");
	  }
	}
} else {
	echo "Not logged in";
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    //include("views/not_logged_in.php");
}
