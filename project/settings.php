<?php
  $team = "4665"; // This should be your FRC team number
  $timezone = "America/Chicago"; // Time zone for clock setting in PHP
  $city = "Glencoe"; //The city for your weather data
  $state = "MN"; // The state for your weather data
  $unit = "F"; // The unit for your temperature; C(elsius), R(ankine), F(arenheit), or K(elvin)
  date_default_timezone_set($timezone); // A bit of ignorable code to make the above work
  
  // Database information: 
  $db['host'] = '127.0.0.1';
  $db['user'] = 'mss';
  $db['password'] = 'robot';
  $db['database'] = 'mss';
?>
