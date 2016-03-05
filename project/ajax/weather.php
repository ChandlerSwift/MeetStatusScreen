<?php
	
	include '../config.php';
	
	$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city  . "," . $state;
	
	$json = file_get_contents($url);
	$data = json_decode($json, TRUE);
	
	$weather = $data['weather'];
	$zero = $weather[0];
	$icon = $zero['icon'];
	$main = $data['main'];
	$description = $zero['description'];
	$kelvin = $main['temp'];
	$fahrenheit = ($kelvin - 273.15) * 9 / 5 + 32;
	$rankine = ($fahrenheit + 459.67);
	$celsius = ($kelvin - 273.15);
	
	$fahrenheit_rounded = round($fahrenheit);
	$kelvin_rounded = round($kelvin);
	$celsius_rounded = round($celsius);
	$rankine_rounded = round($rankine);
	
	if($fahrenheit_rounded == "-0"){ //You need a double equals sign == did  forget that?
		$fahrenheit_rounded = 0;
	}
	
	switch ($unit) {
	    case "F":
	        $temp = $fahrenheit_rounded  . "&deg;F";
	        break;
	    case "C":
	        $temp = $celsius_rounded  . "&deg;C";
	        break;
	    case "K":
	        $temp = $kelvin_rounded  . "&deg;K";
	        break;
	    case "R":
	        $temp = $rankine_rounded  . "&deg;R";
	        break;
	}
	
	//NEED TO DO: POPULATE WEATHER CONDITIONS

	switch ($icon) {
	    case "01d":
	        $wi = "wi-day-sunny";
	        break;
	    case "02d":
	        $wi = "wi-day-cloudy";
	        break;
	    case "03d":
	        $wi =  "wi-cloudy";
	        break;
	    case "04d":
	        $wi = "wi-cloudy";
	        break;
	    case "09d":
	        $wi = "wi-rain";
	        break;
	    case "50d":
	        $wi = "wi-fog";
	        break;
	        
	        
	    case "01n":
	        $wi = "wi-night-clear";
	        break;
	    case "02n":
	        $wi = "wi-night-cloudy";
	        break;
	    case "03n":
	        $wi =  "wi-cloudy";
	        break;
	    case "04n":
	        $wi = "wi-cloudy";
	        break;
	    case "09n":
	        $wi = "wi-rain";
	        break;
	    case "50n":
	        $wi = "wi-fog";
	        break;
	    default:
	    	$wi = "wi-alien";
	    	break;
	}

?>
				<div id="header-weather-text">
					<div id="header-weather-temp">
					<?php echo $temp; ?>
					</div>
					<div id="header-weather-location">
						<?php echo $config['city'] . ', ' . $config['state']; ?>
						<br>
						<?php echo $description; ?>
					</div>
				</div>
				<div id="header-weather-icon">
					<i class="wi <?php echo $wi; ?>" style="font-size: 64pt;"></i>
				</div>