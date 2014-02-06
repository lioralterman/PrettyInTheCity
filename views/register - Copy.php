<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pretty In The City</title>
<style>
.image {
	-webkit-box-shadow: 0 0 18px rgba(0,0,0,.66);
	-moz-box-shadow: 0 0 18px rgba(0,0,0,.66);
	box-shadow: 0 0 18px rgba(0,0,0,.66);
	border: solid 6px #fff;
	width: 511px;
	height: 511px;
	margin: 0 auto 40px;
}
.imageText {
	position: relative;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	top: 460px;
	height: 50px;
	background-color: rgba(0,0,0,0.4);
}
body {
	font-family: Arial, Helvetica, sans-serif;
	background-image: url(images/bg.png);
	margin: 100px 0px;
	padding: 0px;
	text-align: center;
	background-attachment: fixed;
}
#topMenu {
	position: fixed;
	top: 0;
	width: 100%;
	background-image: url(images/topMenuBg1.jpg);
	z-index: 1;
	height: 87px;
	vertical-align: middle;
}
.imageNum {
	display: inline-block;
	color: #FFF;
	font-size: 36px;
	float: left;
	margin-top: 5px;
	margin-left: 5px;
}
.imageName {
	display: inline-block;
	color: #FFF;
	font-size: 20px;
	text-align: center;
	margin-top: 12px;
}
.smashing {
	position: fixed;
	z-index: 1;
	top: 10px;
	left: 200px;
}
.topProfile {
	position: fixed;
	top: 0px;
	right: 200px;
	height: 32px;
	background-color: rgba(255,255,255,0.2);
	padding: 5px;
	z-index: 1;
}
.topProfileImage {
	width: 35px;
	height: 35px;
	margin: 0 auto 40px;
	float: left;
}
.topProfileName {
	display: inline-block;
	color: #FFF;
	font-size: 20px;
	text-align: center;
	margin-top: 5px;
	margin-left: 5px;
}
#button {
	margin: 20px 0 0 0;
	padding: 15px 8px;
	width: 200px;
	cursor: pointer;
	border: 1px solid #2493FF;
	overflow: visible;
	display: inline-block;
	color: #fff;
	font: bold 1.4em arial, helvetica;
	text-shadow: 0 -1px 0 rgba(0,0,0,.4);
	background-color: #2493ff;
	background-image: linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
	transition: background-color .2s ease-out;
	border-radius: 3px;
	box-shadow: 0 2px 1px rgba(0, 0, 0, .3), 0 1px 0 rgba(255, 255, 255, .5) inset;
}
#button:hover {
	background-color: #7cbfff;
	border-color: #7cbfff;
}
#button:active {
	position: relative;
	top: 3px;
	text-shadow: none;
	box-shadow: 0 1px 0 rgba(255, 255, 255, .3) inset;
}
.register input[placeholder] {
	margin: 5px 0;
	padding: 10px;
	box-sizing: border-box;
	border: 1px solid #ccc;
	border-radius: 3px;
	font-size: 20px;
}
.register input[placeholder]:focus {
	outline: 0;
	border-color: #aaa;
	box-shadow: 0 2px 1px rgba(0, 0, 0, .3) inset;
}
.register select {
	margin: 5px 0;
	padding: 10px;
	box-sizing: border-box;
	border: 1px solid #ccc;
	border-radius: 3px;
	font-size: 20px;
}
.register span {
	font-size: 20px
}
.register br {
 font-size:
}
</style>
</head>

<body>
<div id="topMenu"><img src="images/logo.png" style="margin-top:20px" /></div>

<!-- errors & messages --->
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>
<script>
function saveForm() {
        //nothing to work with, get out of here
        if(typeof window.sessionStorage ==="undefined"){return;}
        saveValues("input");
        saveValues("select");
        return true;
}

function loadForm() {
        //nothing to work with, get out of here
        if(typeof window.sessionStorage ==="undefined"){return;}
        setValues("input");
        setValues("select");
}

function saveValues(tag){
        var inputs=document.getElementsByTagName(tag);
        for(var i=0;i<inputs.length;i++){
			if(inputs[i].id!="button" && inputs[i].type!="password" && inputs[i].type!="radio")
                window.sessionStorage.setItem(inputs[i].name, inputs[i].value);
        }
}

function setValues(tag){
        var inputs=document.getElementsByTagName(tag);
        for(var i=0;i<inputs.length;i++){
			if(inputs[i].id!="button" && inputs[i].type!="password" && inputs[i].type!="radio")
                inputs[i].value = window.sessionStorage.getItem(inputs[i].name);
        }
}
</script>
<!-- register form -->
<form method="post" action="register.php" name="registerform" class="register" style="float:left; width:500px">
  
  <!-- the user name input field uses a HTML5 pattern check --> 
  <img src="images/signup.png" /> <br />
  <input id="login_input_firstname" class="register" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_first_name" placeholder="First Name" size="15" style="margin-right:15px" required />
  <input id="login_input_lastname" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_last_name" placeholder="Last Name" size="15" required />
  <br />
  <!-- the email input field uses a HTML5 email type check -->
  <input id="login_input_email" type="email" name="user_email" placeholder="Email" size="40" required />
  <br />
  <input id="login_input_password_new" type="password" name="user_password_new" pattern=".{6,}" placeholder="Password" size="40" required autocomplete="off" />
  <br />
  <input id="login_input_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}"  placeholder="Re-enter Password" size="40" required autocomplete="off" />
  <br />
  <br />
  <span>I am:
  <input type="radio" name="user_sex" value="male">
  Male
  <input type="radio" name="user_sex" value="female">
  Female</span> <br />
  <br />
  <span>Birthday:</span> 
  <select id="login_input_birth_mounth" name="user_birth_month">
    <option>Month</option>
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select>
  <select id="login_input_birth_day"  name="user_birth_day">
    <option>Day</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
  </select>
  <select id="login_input_password_year"  name="user_birth_year">
    <option>Year</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
    <option value="1904">1904</option>
    <option value="1903">1903</option>
    <option value="1902">1902</option>
    <option value="1901">1901</option>
    <option value="1900">1900</option>
  </select>
  <br />
  <br />
  <span> Interested in:
  <input type="radio" name="user_interest" value="women">
  Women
  <input type="radio" name="user_interest" value="men">
  Men</span> <br />
  <br />
  <span style="font-size:12px">By clicking Sign Up, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span> <br />
  <input id="button" type="submit" onclick="return saveForm()" name="register" value="Register" value="Sign Up" />
</form>
<script>loadForm()</script>
<img src="images/prettyImage.png" /> <a href="#">
<div class="topProfile"><!-- login form box -->
<form method="post" action="index.php" name="loginform">
    <label for="login_input_email">Email</label>
    <input id="login_input_email" class="login_input" type="text" name="user_email" required />
    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
    <input type="submit"  name="login" value="Log in" />
</form>

<a href="password_reset.php">I forgot my password</a></div>
</a>
</body>
</html>
