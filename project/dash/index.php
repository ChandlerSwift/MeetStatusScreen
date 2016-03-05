<?php

include('../config.php');

$con=mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);

$date = date ('H:i:s');

if(isset($_GET['d'])){
$d = $_GET['d'];
$sql = "DELETE FROM `event` WHERE ID=" . $d;
$retval = mysqli_query( $con, $sql );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}
}


if(isset($_POST['m'])){
$match = $_POST['m'];
$timeraw = $_POST['t'];
$timeraw = $_POST['t'];
$convert = new DateTime($timeraw);
$time = $convert->format('H:i:s');
$r1 = $_POST['R1'];
$r2 = $_POST['R2'];
$r3 = $_POST['R3'];
$b1 = $_POST['B1'];
$b2 = $_POST['B2'];
$b3 = $_POST['B3'];

$sql = "INSERT INTO `event` (`Match`, `time`, `R1`, `R2`, `R3`, `B1`, `B2`, `B3`) VALUES ('" . $match . "', '" . $time . "', '" . $r1 . "', '" . $r2 . "', '" . $r3 . "', '" . $b1 . "', '" . $b2 . "', '" . $b3 . "')";
$con->query($sql);
}
?>
<html>
<head>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/dashboard.css" rel="stylesheet">
<link href="../css/anytime.5.0.7.min.css" rel="stylesheet">
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-2.1.3.min.js"></script>
<script src="../js/anytime.5.0.7.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Dash</title>
</head>
<body>
<div class="visible-xs visible-sm"></div>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Dash</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../">Display</a></li>
            <li><a href="editsettings.php">Settings</a></li>
            <li><a href="">Refresh</a></li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
          <h1 class="page-header">Match Schedule</h1>
		  		  <div class="table-responsive">
            <table class="table table-striped">
			<thead>
<tr>
<th>Match</th>
<th>Time</th>
<th>Blue 1</th>
<th>Blue 2</th>
<th>Blue 3</th>
<th>Red 1</th>
<th>Red 2</th>
<th>Red 3</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con,"SELECT * FROM `event` ORDER BY time ASC");

while($row = mysqli_fetch_array($result)) {
if($row['time'] < $date){
echo '<tr class="warning">';
}else{
echo '<tr>';
}
echo '<td>' . $row['Match'] . '</td>';
$raw = $row['time'];
$convert = new DateTime($raw);
$time = $convert->format('h:i A');
echo '<td>' . $time . '</td>';
echo '<td>' . $row['B1'] . '</td>';
echo '<td>' . $row['B2'] . '</td>';
echo '<td>' . $row['B3'] . '</td>';
echo '<td>' . $row['R1'] . '</td>';
echo '<td>' . $row['R2'] . '</td>';
echo '<td>' . $row['R3'] . '</td>';
echo "<td><a href='?d=" . $row['ID'] . "' class='btn btn-default'>Delete</a></td>";
echo ' </tr>';
}
?>
<form action="" method="post">
<tr>
<td><input type="text" size="4" name="m"></td>
<td><input type="text" size="4" name="t" id="time"></td>
<td class="info"><input type="text" size="4" name="B1"></td>
<td class="info"><input type="text" size="4" name="B2"></td>
<td class="info"><input type="text" size="4" name="B3"></td>
<td class="danger"><input type="text" size="4" name="R1"></td>
<td class="danger"><input type="text" size="4" name="R2"></td>
<td class="danger"><input type="text" size="4" name="R3"></td>
<td><input type="submit" value="Add" class='btn btn-default'></td>
</tr>
</form>
</tbody>
</table>
<script>
    $("#time").AnyTime_picker(
    { format: " %l:%i %p" } );
</script>
</body>
</html>