<?php include_once "settings.php"; ?>
<!DOCTYPE html>
<html>
	<head>
    <title><?= $teamname ?> FRC Match Information</title> 
		<script src="js/jquery-2.1.3.min.js"></script>
		<link href="css/weather-icons.min.css" rel="stylesheet">
		<script>
			var isTimeoutSet = "no";
			var hadPM = false;
			$(function() { // Only runs once on load
				updateWeather();
				setInterval(updateWeather,60000); // One Minute
				updateTime();
				setInterval(updateTime,200);
				updateTeams();
				updateNum(); // Get Match Number
			});
			function updateWeather() {
				$.get( "ajax/weather.php", function( data ) {
					$( "#header-weather" ).html( data );
					if (/alien/.test(data)) {			// If "Alien" is found in the data, then there is an error.
					setTimeout(updateWeather,1000);		// Try again in a second.
					}
				});
			}
			function updateTime() {
				$.get( "ajax/match.php?time", function( data ) {
					$( "#body-time-left" ).html( data );
					if (data == "0:01") {
					    if (isTimeoutSet == "no") {
							setTimeout(updateAll, 1200);
							isTimeoutSet = "yes";
						}
					}
					if (hadPM != /\b>/.test(data)) { // The clock just switched on or off.
						hadPM = !hadPM;              // So let's switch it.
							updateAll();             // Our other information
					}
				});
			}
			function updateAll() { // Not including Time
				updateTeams(); // Team Table List
				updateNum(); // Upcoming Match Number
				isTimeoutSet = "no";
			}
			function updateNum() { // Get Match Number
				$.get( "ajax/match.php?match", function( data ) {
					$( "#body-until-match" ).html( data);
				});
			}
			function updateTeams() {
				$.get( "ajax/match.php", function( data ) {
					$( "#footer-table" ).html( data );
				});
			}
		</script>
		<style>
			body {
				font-family: Century Gothic;
				background-color: black;
				color: white;
				margin: 0;
				padding: 0;
			}

			#header {
				position: fixed;
				width: 100%;
				height: 100px;
				font-size: 36pt;
			}

			#header-brand {
				width: 50%;
				height: 100%;
				float: left;
			}

			#header-brand p {
				margin-top: 20px;
				margin-left: 20px;
			}

			#header-weather {
				width: 50%;
				height: 100%;
				float: right;
				margin-top: 10px;
				text-align: center;
			}
			#header-weather-icon {
				height: 100%;
				float: right;
				text-align: right;
			}
			#header-weather-text {
				height: 100%;
				float: right;
			}
			#header-weather-temp {
				padding-left: 20px;
				padding-right: 20px;
				text-align: left;
			}
			#header-weather-location {
				padding-left: 20px;
				padding-right: 20px;
				font-size: 12pt;
				text-align: left;
			}
			#content {
				width: 100%;
				position: fixed;
				top: 150px;
				color: white;
				text-align: center;
			}

			#footer {
				position: fixed;
				bottom: 0px;
				width: 100%;
				height: 315px;
				color: white;
				font-size: 36pt;
				overflow: hidden;
			}
			#footer-table {
				width: 50%;
				height: 100%;
				float: left;
			}
			
			#footer-logo {
				float: right;
				width: 50%;
			}
			
			#footer-logo {
				width: 50%;
				height: 100%;
				text-align: center;
			}
			
			#footer-logo img {
				max-height: 100%;
				max-width: 100%;
			}
			
			.red {
				background-color: red;
			}
			.blue {
				background-color: blue;
			}
			.now-playing {
				width: 50%;
				text-align: center;
				font-size: 64pt;
				font-weight: bold; /* (consider this?) It dosn't look the best, but i think it will help to see it from a distance */
			}
			#footer-now-playing {
				border-spacing: 0;
				width: 100%;
			}
			.border{
				    -webkit-box-shadow:inset 0px 0px 0px 10px #fff;
				    -moz-box-shadow:inset 0px 0px 0px 10px #fff;
				    box-shadow:inset 0px 0px 0px 10px #fff;
			}
			a{
				color: #fff;
			}
		</style>
	</head>
	
	<body>
		<a href="dash"><div id="header">
			<div id="header-brand">
				<p><?= $teamname ?> &ndash; <?= $team ?></p>
			</div>
			<div id="header-weather"></div>
		</div></a>

		<div id="content">
			<span id="body-time-left" style="font-size: 192pt;"></span><br>
			<span id="body-until-match" style="font-size: 18pt;"></span>
		</div>
		
		<div id="footer">
			<div id="footer-logo">
				<img src="logo.png" />
			</div>
			<div id="footer-table"></div>
		</div>
		
	</body>
</html>