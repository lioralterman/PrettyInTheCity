<?php
$player_rating = -5;
$opponent_rating = 100;	

echo "Player Ranking: ".$player_rating."<br>";
echo "Opponent Ranking: ".$opponent_rating."<br>";

//formula explained - http://forums.steampowered.com/forums/showthread.php?t=1220287
$chance_of_winning = abs((1 / ( 1 + pow(10, ( ($opponent_rating - $player_rating) / 400) ) )) * 100); //percentage
$chance_of_losing = abs(100 - $chance_of_winning); //percentage

//output chances
echo $chance_of_winning."% chance of winning.<br>";
echo $chance_of_losing."% chance of losing.<br>";

//evaluate and output win and lose points
$k_factor = 32; //a common k factor
$win_points = round($k_factor *  ($chance_of_losing/100)); //k_factor * decimal number
$lose_points = round($k_factor * ($chance_of_winning/100)); //k_factor * decimal number
echo '$win_points: '.$win_points.'<br>';
echo '$lose_points: '.$lose_points.'<br>';

//play game - even odds
if($chance_of_winning > 50){
	$player_rating = $player_rating + $win_points;
	echo "<br><strong>Player Wins</strong><br>";	
	echo "Player Earns $win_points points<br>";	
} else {
	$player_rating = $player_rating - $lose_points;
	$player_rating = ($player_rating < 0 ) ? 0 : $player_rating;
	echo "<br><strong>Player Loses</strong><br>";	
	echo "Player Loses $lose_points points<br>";	
}

//record player rating
$_SESSION['player_rating'] = $player_rating;

echo "Player Ranking: ".$player_rating."<br>";
?>