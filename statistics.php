<?php
$tt_per_q=$_POST['ttaken'];
$dataPoints = array( 
	array("y" => $_POST['unattended'], "label" => "Unattended" ),
	array("y" => $_POST['correct'], "label" => "Correct" ),
	array("y" => $_POST['wrong'], "label" => "Wrong" ),
	
);
 $datapts = array( 
     array("label"=>"Total marks", "symbol" => "TM","y"=>$_POST['total']),
	array("label"=>"Scored marks", "symbol" => "SC","y"=>$_POST['score']),
 );
 $datapts2 = array( 
     array("label"=>"", "symbol" => "","y"=>100-$_POST['accuracy']),
     array("label"=>"", "symbol" => "Accuracy","y"=>$_POST['accuracy']),
);
?>
<!DOCTYPE html>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "No. of Questions Analysis"
	},
	axisY: {
		title: "Attempted Questions"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
var chart2 = new CanvasJS.Chart("chartContainer2", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Score Analytics"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($datapts, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
var chart3 = new CanvasJS.Chart("chartContainer3", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Accuracy"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($datapts2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart3.render();
} 

</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br><hr>
<div style="display:flex;">
    <div id="chartContainer2" style="height: 370px; width: 50%;"></div>
    <div id="chartContainer3" style="height: 370px; width: 50%;"></div>
</div>
<br><hr>
<div  style="height: 370px; width: 100%; margin-left:13%;"><br>
<i class="fa-regular fa-clock mx-3" style="color:black;font-size:30px;display:inline;"></i><h2 style=";">Average Time per Question</h2>
<p style="font-size:20px;"><?php echo number_format($tt_per_q,3)." seconds";?></p>
<a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                        